<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use DateTime;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    public function index() {

        $session_platfrom = Session::get('platform_id');
        if ($session_platfrom == '') {
            Session::put('platform_id', 1);
        }
        Session::save();
        return view('Admin.Dashboard.index');
    }
    
    public function reporting() {

        return view('Admin.Dashboard.reporting');
    }
    

    public function save_session(Request $request) {

        $post = $request->input();


        if (!empty($post)) {
            if (isset($post['client_id']) && $post['client_id'] != "") {
                Session::put('client_id', $post['client_id']);
            }
            if (isset($post['financial_year_id']) && $post['financial_year_id'] != "") {
                Session::put('financial_year_id', $post['financial_year_id']);
            } else {
                Session::put('financial_year_id', '');
            }

            if (isset($post['month_quarter_id']) && $post['month_quarter_id'] != "") {
                Session::put('month_quarter_id', $post['month_quarter_id']);
            } else {
                Session::put('month_quarter_id', '');
            }
            if (isset($post['select_type']) && $post['select_type'] != "") {
                Session::put('select_type', $post['select_type']);
            } else {
                Session::put('select_type', '');
            }
            Session::save();
        }
    }

    public function platfrom_change(Request $request) {

        $post = $request->input();

        $session_platfrom = Session::get('platform_id');
        $platform_id = isset($post['platform_id']) ? $post['platform_id'] : '';
        if (!empty($post)) {
            if ($platform_id != '') {
                Session::put('platform_id', $post['platform_id']);
                Session::save();
            } else {
                if (isset($session_platfrom) && $session_platfrom != '') {
                    Session::put('platform_id', $session_platfrom);
                    Session::save();
                } else {
                    Session::put('platform_id', 1);
                    Session::save();
                }
            }
        }
    }

    public function client_name_search(Request $request) {

        $post = $request->input();

        if (!empty($post)) {


            $client_name = isset($post['searchTerm']) ? $post['searchTerm'] : "";

            $query = DB::table('clients')->select('*');
            $query->where('client_name', 'like', '%' . $client_name . '%');
            $query->orderBy("client_name", "ASC");
            $clients = $query->get()->toArray();

            $data = array();
            foreach ($clients as $key => $value) {

                $data[] = array("id" => $value->id, "text" => $value->client_name);
            }
        }

        echo json_encode($data);
        exit;
    }

    public function financial_year(Request $request) {

        $post = $request->input();

        if (!empty($post)) {

            $client_id = isset($post['client_id']) ? $post['client_id'] : "";
            $searchTerm = isset($post['searchTerm']) ? $post['searchTerm'] : "";

            $query = DB::table('return_period');
            $query->where('client_id', '=', $client_id);
            $query->where('year', 'like', '%' . $searchTerm . '%');

            $financial_year = $query->get()->toArray();

            $data = array();
            foreach ($financial_year as $key => $value) {

                $data[] = array("id" => $value->id, "text" => $value->year);
            }
        }

        echo json_encode($data);
        exit;
    }

    public function month_quarter(Request $request) {

        $post = $request->input();

        $client_id = isset($post['client_id']) ? $post['client_id'] : "";

        $financial_year_id = isset($post['financial_year_id']) ? $post['financial_year_id'] : "";

        $searchTerm = isset($post['searchTerm']) ? $post['searchTerm'] : "";

        $query = DB::table('return_period');

        $query->where('client_id', '=', $client_id);

        $query->where('id', '=', $financial_year_id);

        $month_quarter = $query->first();

        $data = array();
        if (!empty($month_quarter)) {

            if (isset($month_quarter->return_option) && $month_quarter->return_option == 'M') {

                $month_names = array("April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March",);

                $count = 4;
                $count1 = 1;
                for ($i = 0; $i < count($month_names); $i++) {
                    if ($count < 13) {
                        $data[] = array("id" => $count, "text" => $month_names[$i]);
                        $count++;
                    } else {
                        $data[] = array("id" => $count1, "text" => $month_names[$i]);
                        $count1++;
                    }
                }
            } else if (isset($month_quarter->return_option) && $month_quarter->return_option == 'Q') {

                $month_quarters = array("Apr to Jun", "Jul to Sep", "Oct to Dec", "Jan to Mar",);

                $count2 = 1;
                for ($i = 0; $i < count($month_quarters); $i++) {
                    $data[] = array("id" => 'Q' . $count2, "text" => $month_quarters[$i]);
                    $count2++;
                }
            }
        }

        echo json_encode($data);
        exit;
    }

    public function upload_file(Request $request) {

        $result = array();
        $post = $request->input();

        $validation_array = array();
        $out_of_month_quarter = array();

        if (!empty($post)) {

            $client_id = isset($post['client_id']) ? $post['client_id'] : '';
            $financial_year_id = isset($post['financial_year_id']) ? $post['financial_year_id'] : '';
            $month_quarter_id = isset($post['month_quarter_id']) ? $post['month_quarter_id'] : '';
            $select_type = isset($post['select_type']) ? $post['select_type'] : '';
            if ($client_id != '' && $financial_year_id != '' && $month_quarter_id != '') {

                $client_id = $post['client_id'];

                Session::put('client_id', $client_id);
                Session::put('financial_year_id', $financial_year_id);
                Session::put('month_quarter_id', $month_quarter_id);
                Session::save();

                $query = DB::table('clients')->select('*');
                $query->where('id', $client_id);
                $client_detail = $query->first();
                $client_gstin = $client_detail->gstin;

                $all_states = DB::table('state')->pluck('state_name')->toArray();

                $month_quarter = DB::table('return_period')->select('*')
                        ->where('id', $financial_year_id)
                        ->where('client_id', $client_id)
                        ->first();

                if (!empty($month_quarter)) {
                    if (isset($month_quarter->return_option) && $month_quarter->return_option == 'M') {

                        if (isset($month_quarter->year) && $month_quarter->year != "") {

                            $year = explode('-', $month_quarter->year);

                            $month = $month_quarter_id;

                            if ($month > 3) {
                                $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                                $return_time = 'M' . date('my', strtotime($return_date));
                                $start_return_month = date('m/1/Y', strtotime(date($year[0] . "/" . $month . "/1")));
                            } else {
                                $date = strtotime(date($year[0] . "/" . $month . "/t"));
                                $new_date = strtotime('+ 1 year', $date);
                                $return_date = date('m/t/Y', $new_date);
                                $return_time = 'M' . date('my', strtotime($return_date));

                                $date = strtotime(date($year[0] . "/" . $month . "/1"));
                                $new_date = strtotime('+ 1 year', $date);
                                $start_return_month = date('m/1/Y', $new_date);
                            }
                        }
                    } else if (isset($month_quarter->return_option) && $month_quarter->return_option == 'Q') {

                        if (isset($month_quarter->year) && $month_quarter->year != "") {

                            $year = explode('-', $month_quarter->year);

                            $quarter = $month_quarter_id;

                            if ($quarter == 'Q1') {
                                $ret_time = 'Q01';
                                $start_month = '4';
                                $month = '6';
                            } else if ($quarter == 'Q2') {
                                $ret_time = 'Q02';
                                $start_month = '7';
                                $month = '9';
                            } else if ($quarter == 'Q3') {
                                $ret_time = 'Q03';
                                $start_month = '10';
                                $month = '12';
                            } else if ($quarter == 'Q4') {
                                $ret_time = 'Q04';
                                $start_month = '1';
                                $month = '3';
                            }

                            if ($month > 3) {
                                $start_return_month = date('m/1/Y', strtotime(date($year[0] . "/" . $start_month . "/1")));
                                $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                                $return_time = $ret_time . date('y', strtotime($return_date));
                            } else {
                                $date = strtotime(date($year[0] . "/" . $month . "/t"));
                                $new_date = strtotime('+ 1 year', $date);
                                $return_date = date('m/t/Y', $new_date);
                                $return_time = $ret_time . date('y', strtotime($return_date));

                                $start_date = strtotime(date($year[0] . "/" . $start_month . "/1"));
                                $start_new_date = strtotime('+ 1 year', $start_date);
                                $start_return_month = date('m/1/Y', $start_new_date);
                            }
                        }
                    }
                }

                if ($request->hasFile('upload_file')) {
                    $this->validate($request, [
//                            'upload_file' => 'required|mimes:csv',
                        'upload_file' => 'required',
                    ]);

                    $file = $request->file('upload_file');
                    $filename = $file->getClientOriginalName();

                    // Upload file
                    $file->move(public_path('csv_upload'), $filename);

                    // Import CSV to Database
                    $filepath = public_path("csv_upload/" . $filename);

                    // Reading file
                    $fileopen = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($fileopen, 1500, ",")) !== FALSE) {
                        //              while (($filedata = fgetcsv($fileopen)) !== FALSE) {

                        $num = count($filedata);

                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($fileopen);

                    $header_array = array
                        (
                        '0' => 'Seller Gstin',
                        '1' => 'Invoice Number',
                        '2' => 'Invoice Date',
                        '3' => 'Transaction Type',
                        '4' => 'Order Id',
                        '5' => 'Shipment Id',
                        '6' => 'Shipment Date',
                        '7' => 'Order Date',
                        '8' => 'Shipment Item Id',
                        '9' => 'Quantity',
                        '10' => 'Item Description',
                        '11' => 'Asin',
                        '12' => 'Hsn/sac',
                        '13' => 'Sku',
                        '14' => 'Product Tax Code',
                        '15' => 'Bill From City',
                        '16' => 'Bill From State',
                        '17' => 'Bill From Country',
                        '18' => 'Bill From Postal Code',
                        '19' => 'Ship From City',
                        '20' => 'Ship From State',
                        '21' => 'Ship From Country',
                        '22' => 'Ship From Postal Code',
                        '23' => 'Ship To City',
                        '24' => 'Ship To State',
                        '25' => 'Ship To Country',
                        '26' => 'Ship To Postal Code',
                        '27' => 'Invoice Amount',
                        '28' => 'Tax Exclusive Gross',
                        '29' => 'Total Tax Amount',
                        '30' => 'Cgst Rate',
                        '31' => 'Sgst Rate',
                        '32' => 'Utgst Rate',
                        '33' => 'Igst Rate',
                        '34' => 'Compensatory Cess Rate',
                        '35' => 'Principal Amount',
                        '36' => 'Principal Amount Basis',
                        '37' => 'Cgst Tax',
                        '38' => 'Sgst Tax',
                        '39' => 'Igst Tax',
                        '40' => 'Utgst Tax',
                        '41' => 'Compensatory Cess Tax',
                        '42' => 'Shipping Amount',
                        '43' => 'Shipping Amount Basis',
                        '44' => 'Shipping Cgst Tax',
                        '45' => 'Shipping Sgst Tax',
                        '46' => 'Shipping Utgst Tax',
                        '47' => 'Shipping Igst Tax',
                        '48' => 'Shipping Cess Tax Amount',
                        '49' => 'Gift Wrap Amount',
                        '50' => 'Gift Wrap Amount Basis',
                        '51' => 'Gift Wrap Cgst Tax',
                        '52' => 'Gift Wrap Sgst Tax',
                        '53' => 'Gift Wrap Utgst Tax',
                        '54' => 'Gift Wrap Igst Tax',
                        '55' => 'Gift Wrap Compensatory Cess Tax',
                        '56' => 'Item Promo Discount',
                        '57' => 'Item Promo Discount Basis',
                        '58' => 'Item Promo Tax',
                        '59' => 'Shipping Promo Discount',
                        '60' => 'Shipping Promo Discount Basis',
                        '61' => 'Shipping Promo Tax',
                        '62' => 'Gift Wrap Promo Discount',
                        '63' => 'Gift Wrap Promo Discount Basis',
                        '64' => 'Gift Wrap Promo Tax',
                        '65' => 'Tcs Cgst Rate',
                        '66' => 'Tcs Cgst Amount',
                        '67' => 'Tcs Sgst Rate',
                        '68' => 'Tcs Sgst Amount',
                        '69' => 'Tcs Utgst Rate',
                        '70' => 'Tcs Utgst Amount',
                        '71' => 'Tcs Igst Rate',
                        '72' => 'Tcs Igst Amount',
                        '73' => 'Warehouse Id',
                        '74' => 'Fulfillment Channel',
                        '75' => 'Payment Method Code',
                        '76' => 'Credit Note No',
                        '77' => 'Credit Note Date'
                    );


                    if (!empty($importData_arr)) {
                        $x = 'A';

                        $column_diff = array_diff($header_array, $importData_arr[0]);

                        if (empty($column_diff)) {
                            foreach ($importData_arr[0] as $key => $value) {

                                if ($value != $header_array[$key]) {
                                    $validation_array[] = 'Header does not match to given criteria it must be ' . '"' . $header_array[$key] . '"' . ' at column ' . $x . ' row 1.<br>';
                                }
                                $x++;
                            }
                        } else {
                            $validation_array[] = 'Please upload file with correct headers.<br>';
                        }
                    }

                    if (!empty($importData_arr)) {
                        foreach ($importData_arr as $key => $value) {

                            if ($key != 0) {

                                $row = $key + 1;

//                                Column A should match with Client GSTIN.
                                if (isset($value[0]) && $value[0] != '') {

                                    if ($value[0] != $client_gstin) {
                                        $validation_array[] = 'Seller Gstin does not match to client Gstin at column A row ' . $row . '.<br>';
                                    }
                                } else {
                                    $validation_array[] = 'Seller Gstin must not be empty at column A row ' . $row . '.<br>';
                                }
//                                Column A should match with Client GSTIN.
//                                There should be a value in Column B.
                                if ($value[1] == '') {
                                    $validation_array[] = 'Invoice Number must not be empty at column B row ' . $row . '.<br>';
                                }
//                                There should be a value in Column B.  
//                                There should be a valid date in column C.
                                if (isset($value[2]) && $value[2] != '') {

                                    $date_check = date('m/d/Y', strtotime($value[2]));

                                    if (strtotime($date_check) > 0) {

                                        if ($date_check > $return_date) {
                                            $validation_array[] = 'Invoice Date must be a smaller than Month/Quarter last date at column C row ' . $row . '.<br>';
                                        }

                                        if (strtotime($date_check) < strtotime($start_return_month)) {

                                            $out_of_month_header = $importData_arr[0];
                                            $out_of_month_quarter[] = $value;
                                        }
                                    } else {
                                        $validation_array[] = 'Invoice Date must be a valid date at column C row ' . $row . '. Valid format is mm/dd/yyyy.<br>';
                                    }
                                } else {
                                    $validation_array[] = 'Invoice Date must not be empty at column C row ' . $row . '<br>';
                                }

//                                There should be a valid date in column C.
//                              The value in Column Y should be available in State table.
                                if (isset($value[24]) && $value[24] != '') {

                                    if (!(in_array($value[24], $all_states))) {
                                        $validation_array[] = 'Shipping To this State not available at column Y row ' . $row . '.<br>';
                                    }
                                } else {
                                    $validation_array[] = 'Ship To State must not be empty at column Y row ' . $row . '.<br>';
                                }
//                              The value in Column Y should be available in State table.
                            }
                        }
                    }
                }
            } else {
                $validation_array[] = 'Please select all dropdown value.';
            }
        }

        if (empty($validation_array)) {

            $all_states_codes = DB::table('state')->select('*')->get()->toArray();

            $state_code = array();

            foreach ($all_states_codes as $key => $value) {

                $state_code[$value->state_name] = $value->state_code;
            }

            $platform = Session::get('platform_id');

            $sales_array = array();
            $sales_return_array = array();
            $sales_array_total = array();
            $sales_return_total = array();
            $count_ignored_row = 1;
            $count_successful_row = 1;
            foreach ($importData_arr as $key => $value) {

                if ($key != 0) {

                    if (isset($value[33]) && $value[33] > 0) {
                        $gst_rate = $value[33];
                    } else {
                        $gst_rate = (float) $value[30] * 2;
                    }

                    if (isset($value[33]) && $value[33] > 0) {
                        $igst = abs($value[29]);
                    } else {
                        $igst = Null;
                    }

                    if (isset($value[33]) && $value[33] > 0) {
                        $sgst = Null;
                        $cgst = Null;
                    } else {
                        $sgst = abs((float) $value[29]) / 2;
                        $cgst = abs((float) $value[29]) / 2;
                    }


                    if (isset($value[28]) && $value[28] != '') {

                        $gross_total = ((float) $value[29]) + ((float) $sgst) + ((float) $cgst) + ((float) $igst);

                        $rount_off = abs($value[27]) - $gross_total;

                        if ($value[28] >= 0) {

                            $sales_array['client_id'] = isset($client_id) ? $client_id : "";
                            $sales_array['plateform'] = isset($platform) ? $platform : "";
                            $sales_array['return_time'] = isset($return_time) ? $return_time : "";
                            $sales_array['date'] = strtotime(date('Y-m-d', strtotime($value[2]))) > 0 ? date('Y-m-d', strtotime($value[2])) : '';
                            $sales_array['invoice_num'] = isset($value[1]) ? $value[1] : "";
                            $sales_array['gstin'] = '';
                            $sales_array['party_name'] = '';
                            $sales_array['place_of_supply'] = isset($state_code[$value[24]]) ? $state_code[$value[24]] : '';
                            $sales_array['taxable_amount'] = isset($value[29]) ? $value[29] : "";
                            $sales_array['gst_rate'] = isset($gst_rate) ? $gst_rate : "";
                            $sales_array['hsn_sac'] = isset($value[12]) ? $value[12] : "";
                            $sales_array['igst'] = isset($igst) ? $igst : "";
                            $sales_array['sgst'] = isset($sgst) ? $sgst : "";
                            $sales_array['cgst'] = isset($cgst) ? $cgst : "";
                            $sales_array['gross_total'] = isset($gross_total) ? $gross_total : "";
                            $sales_array['round_off'] = isset($rount_off) ? $rount_off : "";
                            $sales_array['invoice_amount'] = isset($value[27]) ? $value[27] : "";
                            $sales_array['type'] = $select_type;
                            $sales_array_total[] = $sales_array;
                        } else {
                            $sales_return_array['client_id'] = isset($client_id) ? $client_id : "";
                            $sales_return_array['plateform'] = isset($platform) ? $platform : "";
                            $sales_return_array['return_time'] = isset($return_time) ? $return_time : "";
                            $sales_return_array['date'] = strtotime(date('Y-m-d', strtotime($value[2]))) > 0 ? date('Y-m-d', strtotime($value[2])) : '';
                            $sales_return_array['invoice_num'] = isset($value[1]) ? $value[1] : "";
                            $sales_return_array['rel_invoice_num'] = '';
                            $sales_return_array['gstin'] = '';
                            $sales_return_array['party_name'] = '';
                            $sales_return_array['place_of_supply'] = isset($state_code[$value[24]]) ? $state_code[$value[24]] : '';
                            $sales_return_array['taxable_amount'] = isset($value[29]) ? abs($value[29]) : "";
                            $sales_return_array['gst_rate'] = isset($gst_rate) ? $gst_rate : "";
                            $sales_return_array['hsn_sac'] = isset($value[12]) ? $value[12] : "";
                            $sales_return_array['igst'] = isset($igst) ? $igst : "";
                            $sales_return_array['sgst'] = isset($sgst) ? $sgst : "";
                            $sales_return_array['cgst'] = isset($cgst) ? $cgst : "";
                            $sales_return_array['gross_total'] = isset($gross_total) ? $gross_total : "";
                            $sales_return_array['round_off'] = isset($rount_off) ? $rount_off : "";
                            $sales_return_array['invoice_amount'] = isset($value[27]) ? abs($value[27]) : "";
                            $sales_return_array['type'] = $select_type;
                            $sales_return_total[] = $sales_return_array;
                        }
                        $rows_successful = $count_successful_row;
                        $count_successful_row++;
                    } else {
                        $rows_ignored = $count_ignored_row;
                        $count_ignored_row++;
                    }
                }
            }


            $sales = DB::table('sales')->insert($sales_array_total);
            $sales_return = DB::table('sales_return')->insert($sales_return_total);
            if ($sales == TRUE && $sales_return == TRUE) {

                $string = '';
                if (!empty($out_of_month_quarter)) {

                    $string .= '<table class="show_row" border="1"><thead>';

                    foreach ($out_of_month_header as $key => $value) {
                        $string .= '<th>' . $value . '</th>';
                    }

                    $string .= '</thead><tbody>';


                    $x = 0;
                    foreach ($out_of_month_quarter as $key => $value) {


                        $string .= '<tr>';
                        while ($x <= 77) {

                            $string .= '<td>' . $value[$x] . '</td>';
                            $x++;
                        }
                        $string .= '</tr>';
                        $x = 0;
                    }

                    $string .= '</tbody>';
                    $string .= '</table>';
                }
                $result['content'] = $string;
                $result['status'] = 1;
                $result['msg'] = $rows_successful . " rows has been successfully imported. " . $rows_ignored . " rows are ignored which has transaction type of Cancel.";
            }
        } else {
            $result['content'] = '';
            $result['status'] = 0;
            $result['msg'] = $validation_array;
        }

        echo json_encode($result);
        exit;
    }

    public function sales_table_data(Request $request) {

        $requestData = $_REQUEST;

        $data = array();

        //This is for order 
        $columns = array(
            0. => 'sl.date',
            1 => 'sl.invoice_num',
            2 => 'st.state_code_name',
            3 => 'sl.taxable_amount',
            4 => 'sl.gst_rate',
            5 => 'sl.hsn_sac',
            6 => 'sl.igst',
            7 => 'sl.sgst',
            8 => 'sl.cgst',
            9 => 'sl.gross_total',
            10 => 'sl.round_off',
            11 => 'sl.invoice_amount',
        );

        $select_query = DB::table('sales as sl')
                ->leftJoin('state_code as st', 'st.id', '=', 'sl.place_of_supply');

        $select_query->select('sl.*', 'st.state_code_name');
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("sl.date", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.invoice_num", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("st.state_code_name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.taxable_amount", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.gst_rate", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.hsn_sac", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.igst", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.sgst", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.cgst", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.gross_total", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.round_off", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.invoice_amount", "like", '%' . $requestData['search']['value'] . '%');
        }

        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("sl.id", "DESC");
        }

        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $sales_list = $select_query->get();


        foreach ($sales_list as $row) {

            $temp['date'] = date('d-m-Y', strtotime($row->date));
            $temp['invoice_num'] = $row->invoice_num;
            $temp['state_code_name'] = $row->state_code_name;
            $temp['taxable_amount'] = $row->taxable_amount;
            $temp['gst_rate'] = $row->gst_rate . " %";
            $temp['hsn_sac'] = $row->hsn_sac;
            $temp['igst'] = $row->igst;
            $temp['sgst'] = $row->sgst;
            $temp['cgst'] = $row->cgst;
            $temp['gross_total'] = $row->gross_total;
            $temp['round_off'] = $row->round_off;
            $temp['invoice_amount'] = $row->invoice_amount;

            $data[] = $temp;
        }


        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
        );
        echo json_encode($json_data);
        exit(0);
    }

    public function sales_return_table_data(Request $request) {

        $requestData = $_REQUEST;

        $data = array();

        //This is for order 
        $columns = array(
            0. => 'sl.date',
            1 => 'sl.invoice_num',
            2 => 'st.state_code_name',
            3 => 'sl.taxable_amount',
            4 => 'sl.gst_rate',
            5 => 'sl.hsn_sac',
            6 => 'sl.igst',
            7 => 'sl.sgst',
            8 => 'sl.cgst',
            9 => 'sl.gross_total',
            10 => 'sl.round_off',
            11 => 'sl.invoice_amount',
        );

        $select_query = DB::table('sales_return as sl')
                ->leftJoin('state_code as st', 'st.id', '=', 'sl.place_of_supply');

        $select_query->select('sl.*', 'st.state_code_name');
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("sl.date", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.invoice_num", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("st.state_code_name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.taxable_amount", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.gst_rate", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.hsn_sac", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.igst", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.sgst", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.cgst", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.gross_total", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.round_off", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("sl.invoice_amount", "like", '%' . $requestData['search']['value'] . '%');
        }

        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("sl.id", "DESC");
        }

        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $sales_list = $select_query->get();

        foreach ($sales_list as $row) {

            $temp['date'] = date('d-m-Y', strtotime($row->date));
            $temp['invoice_num'] = $row->invoice_num;
            $temp['state_code_name'] = $row->state_code_name;
            $temp['taxable_amount'] = $row->taxable_amount;
            $temp['gst_rate'] = $row->gst_rate . " %";
            $temp['hsn_sac'] = $row->hsn_sac;
            $temp['igst'] = $row->sgst;
            $temp['sgst'] = $row->sgst;
            $temp['cgst'] = $row->cgst;
            $temp['gross_total'] = $row->gross_total;
            $temp['round_off'] = $row->round_off;
            $temp['invoice_amount'] = $row->invoice_amount;

            $data[] = $temp;
        }


        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
        );
        echo json_encode($json_data);
        exit(0);
    }

    public function reporting_data(Request $request) {


        Session::put('reporting', 1);
        Session::save();
        $requestData = $_REQUEST;

        $platform_id = Session::get('platform_id');
        $client_id = Session::get('client_id');
        $financial_year_id = Session::get('financial_year_id');
        $month_quarter_id = Session::get('month_quarter_id');
        $select_type = Session::get('select_type');

        if ($client_id != '' && $financial_year_id != '' && $month_quarter_id != '') {

            $month_quarter = DB::table('return_period')->select('*')
                    ->where('id', $financial_year_id)
                    ->where('client_id', $client_id)
                    ->first();


            $return_time = '';
            if (!empty($month_quarter)) {
                if (isset($month_quarter->return_option) && $month_quarter->return_option == 'M') {

                    if (isset($month_quarter->year) && $month_quarter->year != "") {

                        $year = explode('-', $month_quarter->year);

                        $month = $month_quarter_id;

                        if ($month > 3) {
                            $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                            $return_time = 'M' . date('my', strtotime($return_date));
                        } else {
                            $date = strtotime(date($year[0] . "/" . $month . "/t"));
                            $new_date = strtotime('+ 1 year', $date);
                            $return_date = date('m/t/Y', $new_date);
                            $return_time = 'M' . date('my', strtotime($return_date));
                        }
                    }
                } else if (isset($month_quarter->return_option) && $month_quarter->return_option == 'Q') {

                    if (isset($month_quarter->year) && $month_quarter->year != "") {

                        $year = explode('-', $month_quarter->year);

                        $quarter = $month_quarter_id;

                        $month = '';
                        if ($quarter == 'Q1') {
                            $ret_time = 'Q01';
                            $month = '6';
                        } else if ($quarter == 'Q2') {
                            $ret_time = 'Q02';
                            $month = '9';
                        } else if ($quarter == 'Q3') {
                            $ret_time = 'Q03';
                            $month = '12';
                        } else if ($quarter == 'Q4') {
                            $ret_time = 'Q04';
                            $month = '3';
                        }

                        if ($month > 3) {
                            $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                            $return_time = $ret_time . date('y', strtotime($return_date));
                        } else {
                            $date = strtotime(date($year[0] . "/" . $month . "/t"));
                            $new_date = strtotime('+ 1 year', $date);
                            $return_date = date('m/t/Y', $new_date);
                            $return_time = $ret_time . date('y', strtotime($return_date));
                        }
                    }
                }
            }

            //This is for order 
            $columns = array(
                0. => 'st.state_code_name',
                1 => 's.gst_rate',
                2 => 'total_taxable_amount',
                3 => 'total_igst',
                4 => 'total_cgst',
                5 => 'total_sgst',
                6 => 'total',
            );


            $totalData_count = DB::table('sales')
                            ->select('*')
                            ->where('client_id', $client_id)
                            ->where('return_time', $return_time)
                            ->where('type', $select_type)
                            ->whereIn('plateform', [1, 3, 4, 5])
                            ->groupBy('place_of_supply', 'gst_rate')->get();

            $select_query = DB::table('sales as s')
                    ->leftJoin('state_code as st', 'st.id', '=', 's.place_of_supply')
                    ->where('s.client_id', $client_id)
                    ->where('s.return_time', $return_time)
                    ->where('s.type', $select_type)
                    ->whereIn('s.plateform', [1, 3, 4, 5])
                    ->selectRaw("st.state_code_name as place_of_supply,s.gst_rate,SUM(taxable_amount) as total_taxable_amount, SUM(igst) as total_igst, SUM(cgst) as total_cgst, SUM(sgst) as total_sgst")
                    ->groupBy('s.place_of_supply', 's.gst_rate');

            if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
                $select_query->where("st.state_code_name", "like", '%' . $requestData['search']['value'] . '%')
                        ->oRwhere("s.gst_rate", "like", '%' . $requestData['search']['value'] . '%');
//                        ->oRwhere("total_igst", "like", '%' . $requestData['search']['value'] . '%')
//                        ->oRwhere("total_cgst", "like", '%' . $requestData['search']['value'] . '%')
//                        ->oRwhere("total_sgst", "like", '%' . $requestData['search']['value'] . '%');
            }

            if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
                $order_by = $columns[$requestData['order'][0]['column']];
                $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
            } else {
                $select_query->orderBy("place_of_supply", "ASC");
            }

            //This is for pagination
            if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
                $select_query->offset($requestData['start']);
                $select_query->limit($requestData['length']);
            }

            $totalData = count($totalData_count);

            $sales_list = $select_query->get()->toArray();

            $data = array();
            foreach ($sales_list as $row) {

                $temp['place_of_supply'] = $row->place_of_supply;
                $temp['gst_rate'] = $row->gst_rate . " %";
                $temp['total_taxable_amount'] = number_format($row->total_taxable_amount, 2);
                $temp['total_igst'] = number_format($row->total_igst, 2);
                $temp['total_cgst'] = number_format($row->total_cgst, 2);
                $temp['total_sgst'] = number_format($row->total_sgst, 2);
                $temp['total'] = number_format($row->total_taxable_amount + $row->total_igst + $row->total_cgst + $row->total_sgst, 2);

                $data[] = $temp;
            }
        } else {
            $totalData = 0;
            $data = array();
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
        );
        echo json_encode($json_data);
        exit(0);
    }

    public function reporting_sales_return_data(Request $request) {

        $requestData = $_REQUEST;

        $platform_id = Session::get('platform_id');
        $client_id = Session::get('client_id');
        $financial_year_id = Session::get('financial_year_id');
        $month_quarter_id = Session::get('month_quarter_id');
        $select_type = Session::get('select_type');

        if ($client_id != '' && $financial_year_id != '' && $month_quarter_id != '') {

            $month_quarter = DB::table('return_period')->select('*')
                    ->where('id', $financial_year_id)
                    ->where('client_id', $client_id)
                    ->first();

            $return_time = '';
            if (!empty($month_quarter)) {
                if (isset($month_quarter->return_option) && $month_quarter->return_option == 'M') {

                    if (isset($month_quarter->year) && $month_quarter->year != "") {

                        $year = explode('-', $month_quarter->year);

                        $month = $month_quarter_id;

                        if ($month > 3) {
                            $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                            $return_time = 'M' . date('my', strtotime($return_date));
                        } else {
                            $date = strtotime(date($year[0] . "/" . $month . "/t"));
                            $new_date = strtotime('+ 1 year', $date);
                            $return_date = date('m/t/Y', $new_date);
                            $return_time = 'M' . date('my', strtotime($return_date));
                        }
                    }
                } else if (isset($month_quarter->return_option) && $month_quarter->return_option == 'Q') {

                    if (isset($month_quarter->year) && $month_quarter->year != "") {

                        $year = explode('-', $month_quarter->year);

                        $quarter = $month_quarter_id;

                        if ($quarter == 'Q1') {
                            $ret_time = 'Q01';
                            $month = '6';
                        } else if ($quarter == 'Q2') {
                            $ret_time = 'Q02';
                            $month = '9';
                        } else if ($quarter == 'Q3') {
                            $ret_time = 'Q03';
                            $month = '12';
                        } else if ($quarter == 'Q4') {
                            $ret_time = 'Q04';
                            $month = '3';
                        }

                        if ($month > 3) {
                            $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                            $return_time = $ret_time . date('y', strtotime($return_date));
                        } else {
                            $date = strtotime(date($year[0] . "/" . $month . "/t"));
                            $new_date = strtotime('+ 1 year', $date);
                            $return_date = date('m/t/Y', $new_date);
                            $return_time = $ret_time . date('y', strtotime($return_date));
                        }
                    }
                }
            }

            //This is for order 
            $columns = array(
                0. => 'st.state_code_name',
                1 => 's.gst_rate',
                2 => 'total_taxable_amount',
                3 => 'total_igst',
                4 => 'total_cgst',
                5 => 'total_sgst',
                6 => 'total',
            );


            $totalData_count = DB::table('sales_return')
                            ->select('*')
                            ->where('client_id', $client_id)
                            ->where('return_time', $return_time)
                            ->where('type', $select_type)
                            ->whereIn('plateform', [1, 3, 4, 5])
                            ->groupBy('place_of_supply', 'gst_rate')->get();

            $select_query = DB::table('sales_return as s')
                    ->leftJoin('state_code as st', 'st.id', '=', 's.place_of_supply')
                    ->where('s.client_id', $client_id)
                    ->where('s.return_time', $return_time)
                    ->where('s.type', $select_type)
                    ->whereIn('s.plateform', [1, 3, 4, 5])
                    ->selectRaw("st.state_code_name as place_of_supply,s.gst_rate,SUM(taxable_amount) as total_taxable_amount, SUM(igst) as total_igst, SUM(cgst) as total_cgst, SUM(sgst) as total_sgst")
                    ->groupBy('place_of_supply', 'gst_rate');

            if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
                $select_query->where("st.state_code_name", "like", '%' . $requestData['search']['value'] . '%')
                        ->oRwhere("s.gst_rate", "like", '%' . $requestData['search']['value'] . '%');
//                        ->oRwhere("total_igst", "like", '%' . $requestData['search']['value'] . '%')
//                        ->oRwhere("total_cgst", "like", '%' . $requestData['search']['value'] . '%')
//                        ->oRwhere("total_sgst", "like", '%' . $requestData['search']['value'] . '%');
            }

            if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
                $order_by = $columns[$requestData['order'][0]['column']];
                $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
            } else {
                $select_query->orderBy("place_of_supply", "ASC");
            }

            //This is for pagination
            if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
                $select_query->offset($requestData['start']);
                $select_query->limit($requestData['length']);
            }

            $totalData = count($totalData_count);
            $sales_list = $select_query->get()->toArray();

            $data = array();
            foreach ($sales_list as $row) {

                $temp['place_of_supply'] = $row->place_of_supply;
                $temp['gst_rate'] = $row->gst_rate . " %";
                $temp['total_taxable_amount'] = number_format($row->total_taxable_amount, 2);
                $temp['total_igst'] = number_format($row->total_igst, 2);
                $temp['total_cgst'] = number_format($row->total_cgst, 2);
                $temp['total_sgst'] = number_format($row->total_sgst, 2);
                $temp['total'] = number_format($row->total_taxable_amount + $row->total_igst + $row->total_cgst + $row->total_sgst, 2);

                $data[] = $temp;
            }
        } else {
            $totalData = 0;
            $data = array();
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
        );
        echo json_encode($json_data);
        exit(0);
    }

}
