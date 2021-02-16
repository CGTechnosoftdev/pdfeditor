<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\AddressBook;
use App\Http\Requests\AddressBookFormRequest;
use Auth, View, Response;
use Illuminate\Support\Facades\Validator;
use Socialite;
use Google_Client;
use Google_Service_People;

class AddressBookController extends FrontBaseController
{
    public function addressBookList()
    {

        $user = Auth::user();
        $google_client_id = env('GOOGLE_CLIENT_ID');
        $google_client_secret = env('GOOGLE_CLIENT_SECRET');
        $google_redirect_uri = env('GOOGLE_CONTACT_REDIRECT');

        $client = new Google_Client();


        $client->setApplicationName('My application name');
        $client->setClientid($google_client_id);
        $client->setClientSecret($google_client_secret);
        $client->setRedirectUri($google_redirect_uri);
        $client->setAccessType('online');

        $client->setScopes('https://www.google.com/m8/feeds');



        $googleImportUrl = $client->createAuthUrl();

        $data_array = [
            'title' => 'Address List',
            'googleImportUrl' => $googleImportUrl,
            'MESSAGE_SHOW_TIME' => config('constant.MESSAGE_SHOW_TIME'),
        ];
        return view('front.address-book.index', $data_array);
    }

    public function getAddressListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->all();
        $address_params = ['user_id' => $user->id];
        $address_params['search_text'] = $input_data['search_text'] ?? null;
        $address_book_items = AddressBook::getAddressBook($address_params);
        $data_array = [
            'title' => 'Address List',
            'address_book_items' => $address_book_items,
            'search_text' => $address_params['search_text'],
        ];
        $view = View::make('front.address-book.item-list')->with($data_array)->render();
        $count = count($address_book_items);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function addressBookDelete(Request $request)
    {
        $dataArray = $request->all();

        //dd($dataArray);
        $is_valid = 1;

        if (empty($dataArray["address_book_item"])) {
            $response_type = 'error';
            $operation = "Delete";
            $response_message = 'Please check atleast one item before ' . $operation;
        } else {


            if (!empty($dataArray["address_book_item"])) {
                foreach ($dataArray["address_book_item"] as $address_id => $address_value) {

                    $address_book = AddressBook::find($address_id);

                    if (!$address_book->delete()) {
                        $is_valid = 0;
                    }
                }
                if ($is_valid == 1) {
                    $response_type = 'success';
                    $response_message = 'Adress Item deleted successfully';
                } else {
                    $response_type = 'error';
                    $response_message = 'Adress Item not deleted successfully';
                }
            }
        }
        set_flash($response_type, $response_message);
        return redirect()->route("front.address-book-list");
    }

    public function  addressBookItemDelete(Request $request)
    {
        $is_valid = 1;
        $address_item_id = $request["address_item_id"];
        $address_book = AddressBook::find($address_item_id);
        $response_type = 'success';
        $response_message = 'Adress Item deleted successfully';

        if (!$address_book->delete()) {
            $response_type = 'error';
            $response_message = 'Adress Item not deleted successfully';
        }

        set_flash($response_type, $response_message);

        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }

    public function customAddressBookValidate($data)
    {
        $request = new AddressBookFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
    }
    public function addressBookItemAdd(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->all();
        $input_data["users_id"] = $user->id;

        $validator = $this->customAddressBookValidate($input_data);
        $is_valid = 1;
        if ($validator->fails()) {
            $is_valid = 0;
            $errormessages = $validator->getMessageBag()->getMessages();
            $response_message = "";
            foreach ($errormessages as $errorIndex => $errorMsgArr) {

                foreach ($errorMsgArr as $indder_index => $message) {
                    $response_message .= $message . '<br/>';
                }
            }
            $response_type = "error";
        }

        if ($is_valid == 1) {
            $address_book = AddressBook::saveData($input_data);
            if ($address_book) {
                $response_type = 'success';
                $response_message = 'Address added successfully!';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        }

        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function getaddressBookItemEdit(AddressBook $address_book)
    {

        $data_array = array();
        $response_type = "error";
        if (!empty($address_book)) {
            $data_array = [
                'name' => $address_book->name,
                'email' => $address_book->email,
                'phone' => $address_book->phone,
                'fax' => $address_book->fax
            ];
            $response_type = "success";
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $data_array
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function addressBookItemEdit(Request $request, AddressBook $address_book)
    {

        $user = Auth::user();
        $input_data = $request->all();
        $input_data["users_id"] = $user->id;
        $validator = $this->customAddressBookValidate($input_data);
        $is_valid = 1;
        if ($validator->fails()) {
            $is_valid = 0;
            $errormessages = $validator->getMessageBag()->getMessages();
            $response_message = "";
            foreach ($errormessages as $errorIndex => $errorMsgArr) {

                foreach ($errorMsgArr as $indder_index => $message) {
                    $response_message .= $message . '<br/>';
                }
            }
            $response_type = "error";
        }

        if ($is_valid == 1) {
            $address_book = AddressBook::saveData($input_data, $address_book);
            if ($address_book) {
                $response_type = 'success';
                $response_message = 'Address edit successfully!';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        }

        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function getGoogleContacts(Request $request)
    {
        $user = Auth::user();
        $google_client_id = env('GOOGLE_CLIENT_ID');
        $google_client_secret = env('GOOGLE_CLIENT_SECRET');
        $google_redirect_uri = env('GOOGLE_CONTACT_REDIRECT');

        $client = new Google_Client();


        $client->setApplicationName('My application name');
        $client->setClientid($google_client_id);
        $client->setClientSecret($google_client_secret);
        $client->setRedirectUri($google_redirect_uri);
        $client->setAccessType('online');

        $client->setScopes('https://www.google.com/m8/feeds');



        // $googleImportUrl = $client->createAuthUrl();

        function curl($url, $post = "")
        {
            $curl = curl_init();
            $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
            curl_setopt($curl, CURLOPT_URL, $url);
            //The URL to fetch. This can also be set when initializing a session with curl_init().
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            //The number of seconds to wait while trying to connect.
            if ($post != "") {
                curl_setopt($curl, CURLOPT_POST, 5);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            }
            curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
            //The contents of the "User-Agent: " header to be used in a HTTP request.
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
            //To follow any "Location: " header that the server sends as part of the HTTP header.
            curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
            //To automatically set the Referer: field in requests where it follows a Location: redirect.
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            //The maximum number of seconds to allow cURL functions to execute.
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            //To stop cURL from verifying the peer's certificate.
            $contents = curl_exec($curl);
            //var_dump(curl_getinfo($curl));
            curl_close($curl);

            return $contents;
        }

        //google response with contact. We set a session and redirect back
        if (isset($_GET['code'])) {
            $auth_code = $_GET["code"];
            $_SESSION['google_code'] = $auth_code;
        }
        $google_contacts = array();
        $viewData["message"] = "";
        if (isset($_SESSION['google_code'])) {
            $auth_code = $_SESSION['google_code'];
            $max_results = 200;
            $fields = array(
                'code' =>  urlencode($auth_code),
                'client_id' =>  urlencode($google_client_id),
                'client_secret' =>  urlencode($google_client_secret),
                'redirect_uri' =>  urlencode($google_redirect_uri),
                'grant_type' =>  urlencode('authorization_code')
            );
            $post = '';
            foreach ($fields as $key => $value) {
                $post .= $key . '=' . $value . '&';
            }
            $post = rtrim($post, '&');
            $result = curl('https://accounts.google.com/o/oauth2/token', $post);
            $response =  json_decode($result);

            //echo 'response is <pre>';
            // print_r($response);
            //echo '</pre>';
            $accesstoken = $response->access_token;
            $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=' . $max_results . '&alt=json&v=3.0&oauth_token=' . $accesstoken;
            $xmlresponse =  curl($url);
            $contacts = json_decode($xmlresponse, true);
            //  dd($contacts);

            $return = array();

            if (!empty($contacts['feed']['entry'])) {
                $contactsOfEmailAddress = $contacts['feed']["id"]['$t'];

                foreach ($contacts['feed']['entry'] as $contact) {
                    //retrieve Name and email address  
                    // 'email' => $contact['gd$email'][0]['address'],
                    $return[] = array(
                        'name' => $contact['title']['$t'],
                        'email' => (isset($contact['gd$email'][0]['address']) ? $contact['gd$email'][0]['address'] : ""),
                    );
                }
            }

            $google_contacts = $return;

            //echo 'google contacts <pre>';
            // print_r($contacts);
            // echo '</pre>';
            // echo '<br> contact  email address of '.$contactsOfEmailAddress;

            if (!empty($contactsOfEmailAddress)) {
                if (count($return) > 0) {
                    foreach ($return as $email_index => $accountDetail) {
                        $email = trim($accountDetail["email"]);
                        $name = trim($accountDetail["name"]);
                        $address_book = AddressBook::where(['email' => $email, 'users_id' => $user->id])->get();

                        if (count($address_book) > 0) {
                            $data_array["name"] = $name;

                            AddressBook::saveData($data_array, $address_book[0]);
                        } else {
                            $data_array["name"] = $name;
                            $data_array["email"] = $email;
                            $data_array["users_id"] = $user->id;
                            AddressBook::saveData($data_array);
                        }
                    }
                }
            }
            $viewData["message"] = "Get all contact is system, thank you!";
            unset($_SESSION['google_code']);

            $response_type = 'success';
            $response_message = 'Google Contacts added successfully';


            set_flash($response_type, $response_message);
            return redirect()->route("front.address-book-list");
        }
        //  $viewData["googleImportUrl"] = $googleImportUrl;
        $viewData["google_contacts"] = @$google_contacts;


        // session()->flash('success','Get all contact is system, thank you!');
        return view("google/getcontacts")->with('viewData', $viewData);
        // return redirect()->to('/home');
    }
    public function getYahooContacts(Request $request)
    {
        dd($request->all());
    }
}
