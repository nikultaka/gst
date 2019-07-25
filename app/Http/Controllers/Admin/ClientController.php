<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    public function index() {

        $data_result = array();

        $users = DB::table('users')->where('status', '=', 1)->where('role_id', '=', 0)->get();
        $data_result['users'] = $users;
        return view("Admin.client.client_list")->with($data_result);
    }

    public function add_client_view() {

        $data_result = array();

        $client_years = array();
        $earliest_year = 2017;
        $latest_year = date('Y');
        $Month = 3;
        $years = array();
        foreach (range($earliest_year, $latest_year) as $year) {

            if (date("m") <= $Month) {
                if ($year < date("Y")) {
                    $years[] = date("y", strtotime('1-1-' . $year)) . '-' . date("Y", strtotime('1-1-' . $year . '+1 year'));
                }
            } else {
                $years[] = date("y", strtotime('1-1-' . $year)) . '-' . date("Y", strtotime('1-1-' . $year . '+1 year'));
            }
        }

        $users = DB::table('users')->where('status', '=', 1)->where('role_id', '=', 0)->get();
        $data_result['users'] = $users;
        $data_result['years'] = $years;
        $data_result['client_years'] = $client_years;
        return view("Admin.client.addclient")->with($data_result);
    }

    public function add(Request $request) {
        $data = array();
        $result = array();
        $result['status'] = 0;

        $post = $request->input();

        if (!empty($post)) {
            if (isset($post['client_id']) && $post['client_id'] != "") {
                $id = $post['client_id'];
            }

            $data['user_id'] = Auth::user()->id;
            $data['client_name'] = isset($post['cl_name']) ? $post['cl_name'] : '';
            $data['gstin'] = isset($post['gstin']) ? $post['gstin'] : '';
            $data['status'] = 1;

            if (isset($post['client_id']) && $post['client_id'] != '') {

                $returnresult = DB::table('clients')
                        ->where('id', $id)
                        ->update($data);
                
                $clientresult = "";

                $i = 0;
                foreach ($post as $key => $value) {

                    if (array_key_exists("years_" . $i, $post)) {

                        $year_array = explode('/', $post["years_" . $i]);

                        $return_data['client_id'] = $id;
                        $return_data['year'] = isset($year_array[0]) ? $year_array[0] : "";
                        $return_data['return_option'] = isset($year_array[1]) ? $year_array[1] : "";

                        $client = DB::table('return_period')
                                ->where($return_data)
                                ->first();

                        if (empty($client)) {
                            $clientresult = DB::table('return_period')->insertGetId($return_data);
                        }
                        $i++;
                    }
                }

                if ($returnresult || $clientresult) {
                    $result['status'] = 1;
                    $result['msg'] = 'Client has been updated successfully.!';
                } else {
                    $result['status'] = 0;
                    $result['msg'] = "Something went wrong try again.";
                }
            } else {

                $insert_id = DB::table('clients')->insertGetId($data);

                if ($insert_id != "") {

                    $i = 0;
                    foreach ($post as $key => $value) {

                        if (array_key_exists("years_" . $i, $post)) {

                            $year_array = explode('/', $post["years_" . $i]);

                            $return_data['client_id'] = $insert_id;
                            $return_data['year'] = isset($year_array[0]) ? $year_array[0] : "";
                            $return_data['return_option'] = isset($year_array[1]) ? $year_array[1] : "";

                            DB::table('return_period')->insertGetId($return_data);
                            $i++;
                        }
                    }


                    $result['status'] = 1;
                    $result['msg'] = "Client has been added successfully..!";
                } else {
                    $result['status'] = 0;
                    $result['msg'] = "Something went wrong try again.";
                }
            }
        }
        echo json_encode($result);
        exit;
    }

    public function edit($id) {

        $client = "";
        $users = DB::table('users')->where('status', '=', 1)->where('role_id', '=', 0)->get();
        if (isset($id) && $id != '') {

            $client = DB::table('clients')
                    ->where('id', '=', $id)
                    ->first();

            $return_period = DB::table('return_period')
                            ->where('client_id', '=', $id)
                            ->get()->toArray();
        }


        if (!empty($return_period)) {
            foreach ($return_period as $key => $value) {
                $client_years[] = $value->year . '/' . $value->return_option;
            }
        }

        $earliest_year = 2017;
        $latest_year = date('Y');
        $Month = 3;
        $years = array();
        foreach (range($earliest_year, $latest_year) as $year) {

            if (date("m") <= $Month) {
                if ($year < date("Y")) {
                    $years[] = date("y", strtotime('1-1-' . $year)) . '-' . date("Y", strtotime('1-1-' . $year . '+1 year'));
                }
            } else {
                $years[] = date("y", strtotime('1-1-' . $year)) . '-' . date("Y", strtotime('1-1-' . $year . '+1 year'));
            }
        }

        $data_result['client'] = $client;
        $data_result['users'] = $users;
        $data_result['client_years'] = $client_years;
        $data_result['years'] = $years;
        return view("Admin.client.addclient")->with($data_result);
    }

    public function delete(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                $check_user_sales = DB::table('sales')
                        ->where('client_id', '=', $id)
                        ->count();

                $check_user_sales_return = DB::table('sales_return')
                        ->where('client_id', '=', $id)
                        ->count();

                if ($check_user_sales == 0 && $check_user_sales_return == 0) {

                    $client = DB::table('clients')
                            ->where('id', $id)
                            ->update(array('status' => -1));

                    if ($client) {
                        $data_result['status'] = 1;
                        $data_result['msg'] = "Record deleted successfully.";
                    } else {
                        $data_result['status'] = 0;
                        $data_result['msg'] = "Something went wrong.";
                    }
                } else {
                    $data_result['status'] = 0;
                    $data_result['msg'] = "You can't delete this user.";
                }
            }
        }
        echo json_encode($data_result);
        exit;
    }

    public function client_data_table() {

        $requestData = $_REQUEST;

        $data = array();

        //This is for order 
        $columns = array(
//            0. => 'u.name',
            0 => 'c.client_name',
            1 => 'c.gstin',
        );

        $select_query = DB::table('clients as c')
                ->leftJoin('users as u', 'u.id', '=', 'c.user_id')
//                ->where('u.role_id', '=', 0)
                ->where('u.status', '=', 1)
                ->where('c.status', '=', 1);

        $select_query->select('c.*', 'u.name');
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("u.name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("c.client_name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("c.gstin", "like", '%' . $requestData['search']['value'] . '%');
        }

        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("c.client_name", "ASC");
        }

        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $client_list = $select_query->get();


        foreach ($client_list as $row) {

//            $temp['name'] = $row->name;
            $temp['client_name'] = $row->client_name;
            $temp['gstin'] = $row->gstin;

            $id = $row->id;

            $action = '<div class="datatable_btn" style="display:flex;"><a href="' . url('/clients/edit/' . $id) . '" data-id="' . $id . '" class="btn btn-xs btn-info btnEdit_client"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" type="button" class="btn btn-xs btn-danger btnDelete_client"> Delete</a></div>';


            $temp['action'] = $action;
            $data[] = $temp;
            $id = "";
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
