<?php

namespace App\Traits;

use Auth;
use Stripe\StripeClient;
use Stripe\Stripe;
use App\Models\SubscriptionPlan;
use App\Models\User;

trait StripePaymentTrait
{

	/**
	 * [createCardToken description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function createCardToken($data_array)
	{
		try {
			list($expiry_month, $expiry_year) = explode("/", $data_array['expiry_date']);
			$card_data = [
				'number' => $data_array['card_number'], //str_replace("-", "", $data_array['card_number']),
				'name' => $data_array['name'] ?? $data_array['first_name'] . " " . $data_array['last_name'],
				'exp_month' => $expiry_month,
				'exp_year' => $expiry_year,
				'cvc' => $data_array['cvv'],
			];
			$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
			$token_response =  $stripe->tokens->create([
				'card' => $card_data,
			]);
			if (!empty($token_response->id)) {
				$response_status = true;
				$response_data = $token_response->id;
			}
		} catch (\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getMessage();
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? (empty($response_status) ? 'Error occoured, Please try again.' : ''),
		];
	}

	/**
	 * [createCustomer description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function createCustomer($data_array)
	{
		try {
			$user = auth()->user();
			if (empty($data_array['token'])) {
				$token_response = $this->createCardToken($data_array);
				if (!empty($token_response['success'])) {
					$token = $token_response['data'];
				} else {
					$response_message = $token_response['message'];
				}
			} else {
				$token = $data_array['token'];
			}

			if (!empty($token) && !empty($user)) {
				$email = $user->email;
				$name = $user->first_name . " " . $user->last_name;
				$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
				$customer_response =  $stripe->customers->create([
					'source' => $token,
					'email' => $email,
					'name' => $name,
				]);
				if (!empty($customer_response->id)) {
					User::saveData(['stripe_customer_id' => $customer_response->id], $user);
					$response_status = true;
					$response_data = $customer_response->id;
				}
			}
		} catch (\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getMessage();
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? (empty($response_status) ? 'Error occoured, Please try again.' : ''),
		];
	}

	/**
	 * [chargePayment description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function chargePayment($data_array, $user = [])
	{
		try {
			$user = $user ?? auth()->user();
			if (empty($user->stripe_customer_id)) {
				$customer_response = $this->createCustomer($data_array);
				if (!empty($customer_response['success'])) {
					$customer_id = $customer_response['data'];
				} else {
					$response_message = $customer_response['message'];
				}
			} else {
				$customer_id = $user->stripe_customer_id;
			}
			if (empty($data_array['amount'])) {
				$subscription_plan = SubscriptionPlan::dataRow(['id' => $data_array['subscription_plan_id']]);
				if ($data_array['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_MONTHLY')) {
					$data_array['amount'] = $subscription_plan['monthly_amount'];
				} elseif ($data_array['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY')) {
					$data_array['amount'] = $subscription_plan['yearly_amount'];
				}
			}
			if (!empty($customer_id) && !empty($data_array['amount'])) {
				if (empty($data_array['trail_days'])) {
					$currency = strtolower($data_array['currency']);
					$description = "Payment of amount " . $data_array['amount'];
					$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
					$response_data =  $stripe->charges->create([
						'amount' => (int) ($data_array['amount'] * 100),
						'currency' => $currency,
						'customer' => $customer_id,
						'description' => $description,
					]);
				}
				$response_status = true;
			}
		} catch (\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getMessage();
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? (empty($response_status) ? 'Error occoured, Please try again.' : ''),
		];
	}

	/**
	 * [createCardToken description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function getCardDetail($customer_id)
	{
		$response_data = [];
		try {
			$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
			$card_detail = $stripe->customers->allSources(
				$customer_id,
				['object' => 'card', 'limit' => 1]
			);
			if (!empty($card_detail['data']) && !empty($card_detail['data'][0])) {
				$response_data = $card_detail['data'][0]->toArray();
			}
		} catch (Exception $e) {
			$response_data = [];
		}
		return $response_data;
	}

	/**
	 * [createCustomer description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function linkCardToCustomer($token)
	{
		try {
			$user = auth()->user();
			if (!empty($user->stripe_customer_id)) {
				$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
				$source_response = $stripe->customers->createSource(
					$user->stripe_customer_id,
					['source' => $token]
				);
				if (!empty($source_response->id)) {
					$customer_response =  $stripe->customers->update(
						$user->stripe_customer_id,
						['default_source' => $source_response->id]
					);
					if (!empty($customer_response->id)) {
						$response_status = true;
						$response_data = $customer_response->id;
					}
				}
			}
		} catch (\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getMessage();
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getMessage();
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? (empty($response_status) ? 'Error occoured, Please try again.' : ''),
		];
	}
}
