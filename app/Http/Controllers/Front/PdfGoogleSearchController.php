<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Google_Service_Customsearch;
use Google_Client;


class PdfGoogleSearchController extends FrontBaseController
{
    public function index()
    {

        $data_array = [
            'title' => 'Welcome to the fillable PDF form libraryHeading',
            'heading' => 'Welcome to the fillable PDF form libraryHeading',
            'detail' => 'Choose from 25 million fillable PDF forms in the PDF writer online library. Fill out a fillable form, customize it to your needs, and send it to your customers and clients.',
        ];
        return view('front.pdf-search.index', $data_array);
    }
    public function googlePdfSearch(Request $request)
    {
        try {
            //pdf_search
            $input_data = $request->all();
            $response_type = 'success';
            $GCSE_API_KEY = env('GCSE_API_KEY');
            $GCSE_SEARCH_ENGINE_ID = env('GCSE_SEARCH_ENGINE_ID');
            $pdf_search = trim($_POST["pdf_search"]);

            $start = config("constant.PAGINATION_START_INDEX");
            $limit = config("constant.PAGINATION_LIMIT");
            $no_of_pages = 0;
            $current_page = config("constant.PAGINATION_START_INDEX");
            if (!empty($input_data["page"])) {
                $current_page = $input_data["page"];
            }

            if (!empty($input_data["page"]) && $input_data["page"] > 1)
                $start = ($limit * ($input_data["page"] - 1)) + 1;



            $client = new Google_Client();


            $client->setApplicationName("My_App");

            $client->setDeveloperKey($GCSE_API_KEY);



            $service = new Google_Service_Customsearch($client);
            //"fileType" => "pdf",
            //, "start" => $current_page
            $optParams = array("q" => $pdf_search, "fileType" => "pdf",  "cx" => $GCSE_SEARCH_ENGINE_ID);

            $results = $service->cse->listCse($optParams);

            //  echo '<pre>';
            // print_r($results);
            //echo '</pre>';

            $result_count = $results->queries->request[0]->count;
            $pages_array = array();

            if ($result_count > 0) {

                $no_of_pages = $result_count / $limit;
                if ($result_count % $limit != 0) {
                    $no_of_pages += 1;
                }

                $next_button_html = "";
                $prev_button_html = "";


                if ($current_page >= ($no_of_pages - 1)) {
                    $next_button_html = ' <li class="page-item "><a href="#" class="page-link" id="pdf_page_' . config("constant.PAGINATION_START_INDEX") . '" data-id="' . config("constant.PAGINATION_START_INDEX")  . '">Next</a></li>';
                } else {
                    $next_button_html = ' <li class="page-item "><a href="#" class="page-link" id="pdf_page_' . ($current_page + 1) . '" data-id="' . ($current_page + 1)  . '">Next</a></li>';
                }

                if ($current_page == config("constant.PAGINATION_START_INDEX")) {
                    $prev_button_html = ' <li class="page-item disabled"><a href="#" class="page-link" id="" data-id="">Previous</a></li>';
                } else {
                    $prev_button_html = ' <li class="page-item "><a href="#" class="page-link"  id="pdf_page_' . ($current_page - 1) . '" data-id="' . ($current_page - 1)  . '">Previous</a></li>';
                }

                $showing_index = $limit;
                if (($result_count - $start) < $limit) {
                    $showing_index = ($result_count - $start) + 1;
                } elseif ($limit > $result_count) {
                    $showing_index = $result_count;
                }

                $pageination_html = '<div class="pagination-part">
                <div class="row d-sm-flex align-items-center">
                    <div class="col-sm-6">
                        <p>Showing ' . $showing_index . ' results of ' . $result_count . ' records</p>
                    </div>
                    <div class="col-sm-6">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">' . $prev_button_html;
                for ($page_index = 1; $page_index <= $no_of_pages; $page_index++) {
                    $active_class = "";
                    if ($current_page == $page_index) {
                        $active_class = " active";
                    }

                    $pageination_html .= '
                    <li class="page-item ' . $active_class . '"><a href="#"  class="page-link" id="pdf_page_' . $page_index . '" data-id="' . $page_index  . '">' . $page_index . '</a>
                    </li>
                    ';
                }
                $pageination_html .= $next_button_html . '
                </ul>
                </nav>
            </div>
        </div>
    </div>
                
                ';




                $response_message = '<h2>Search Results for <span class="red-color">"' . $pdf_search . '"</span> in PDF Writer search engine</h2>';
                $view_index = 1;
                foreach ($results->getItems() as $k => $item) {
                    if ($view_index >= $start && $view_index < ($start + $limit)) {
                        $response_message .= '
                    <div class="search-result-card">
                    <div class="result-icon">
                        <img src="' . asset('public/front/images/file.svg') . '">
                    </div>
                    <div class="result-content">
                        <h5>' . $item->htmlTitle . '</h5>
                        <p>' . $item->htmlSnippet . '</p>
                        <a href="' . $item->link . '" target="_blank">Fill Online</a>
                    </div>
                </div>
                    ';
                    }
                    $view_index += 1;
                }
                $response_message .= $pageination_html;
            } else {
                $response_message = "No search result found.";
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }



        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message,
            'no_of_pages'    => $no_of_pages,
        ), (($response_type == 'success') ? 200 : 422));
    }
}
