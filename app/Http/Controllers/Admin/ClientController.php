<?php

namespace App\Http\Controllers\Admin;

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

    public function add(Request $request) {
        $data = array();
        $result = array();
        $result['status'] = 0;

        $post = $request->input();


        if (!empty($post)) {
            if (isset($post['client_id']) && $post['client_id'] != "") {
                $id = $post['client_id'];
            }

            $data['user_id'] = isset($post['user_id']) ? $post['user_id'] : '';
            $data['client_name'] = isset($post['cl_name']) ? $post['cl_name'] : '';
            $data['gstin'] = isset($post['gstin']) ? $post['gstin'] : '';
            $data['status'] = 1;

            if (isset($post['client_id']) && $post['client_id'] != '') {

                $returnresult = DB::table('clients')
                        ->where('id', $id)
                        ->update($data);

                if ($returnresult) {
                    $result['status'] = 1;
                    $result['msg'] = 'Record updated successfully.!';
                } else {
                    $result['status'] = 0;
                    $result['msg'] = "Something went wrong try again.";
                }
            } else {

                if (DB::table('clients')->insert($data)) {
                    $result['status'] = 1;
                    $result['msg'] = "Record add sucessfully..!";
                } else {
                    $result['status'] = 0;
                    $result['msg'] = "Something went wrong try again.";
                }
            }
        }
        echo json_encode($result);
        exit;
    }

    public function edit(Request $request) {
        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                $client = DB::table('clients')
                        ->where('id', '=', $id)
                        ->first();

                $data_result['status'] = 1;
                $data_result['content'] = $client;
            }
        }
        echo json_encode($data_result);
        exit;
    }

    public function delete(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

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
            0. => 'u.name',
            1 => 'c.client_name',
            2 => 'c.gstin',
        );

        $select_query = DB::table('clients as c')
                ->leftJoin('users as u', 'u.id', '=', 'c.user_id')
                ->where('u.role_id', '=', 0)
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
            $select_query->orderBy("c.id", "DESC");
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

            $temp['name'] = $row->name;
            $temp['client_name'] = $row->client_name;
            $temp['gstin'] = $row->gstin;

            $id = $row->id;

            $action = '<div class="datatable_btn" style="display:flex;"><a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-info btnEdit_client"> Edit</a>  	&nbsp;';
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
