<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\AddressBook;
use App\Http\Requests\AddressBookFormRequest;
use Auth, View, Response;
use Illuminate\Support\Facades\Validator;

class AddressBookController extends FrontBaseController
{
    public function addressBookList()
    {
        $data_array = [
            'title' => 'Address List',
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
}
