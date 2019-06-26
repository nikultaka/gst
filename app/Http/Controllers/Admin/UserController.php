<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        $data_result = array();
        //$user_role = DB::table('user_role')->where('status', '=', 1)->get();
        //$data_result['user_role'] = $user_role;
        $data_result='';
        return view("Admin.user.user_list")->with($data_result);
    }
    public function add(Request $request){
        $data = array();
        $result = array();
        $result['status'] = 0;

        $post = $request->input();

        if (!empty($post)) {
            if (isset($post['user_id'])) {
                $id = $post['user_id'];
            }else{
               $data['password'] = isset($post['password']) ? bcrypt($post['password']) : ''; 
            }

            $data['role_id'] = isset($post['role_name']) ? $post['role_name'] : '';
            $data['name'] = isset($post['u_name']) ? $post['u_name'] : '';
            $data['email'] = isset($post['email']) ? $post['email'] : '';
            
            $data['status'] = isset($post['status']) ? $post['status'] : '';


            if (isset($post['user_id']) && $post['user_id'] != '') {
                $user = DB::table('users')
                                ->where('id', '=', $id)->first();
                if($post['password'] != $user->password){
                    $data['password'] = isset($post['password']) ? bcrypt($post['password']) : '';
                }
                $data['updated_at'] = date("Y-m-d h:i:s");
                
                $returnresult = DB::table('users')
                        ->where('id', $id)
                        ->update($data);

                if ($returnresult) {
                    $result['status'] = 1;
                    $result['msg'] = 'Record updated successfully.!';
                }
            } else {

                $data['created_at'] = date("Y-m-d h:i:s");
                if (DB::table('users')->insert($data)) {
                    $result['status'] = 1;
                    $result['msg'] = "Record add sucessfully..!";
                }
            }
        }
        echo json_encode($result);
        exit;
    }
    public function edit(Request $request){
        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                $user = DB::table('users')
                                ->where('id', '=', $id)->first();

                $data_result['status'] = 1;
                $data_result['content'] = $user;
            }
        }
        echo json_encode($data_result);
        exit;
    }
    
    public function email_check(Request $request)
    {
        $result = array();
        $post = $request->input();

        
        if(!empty($post)){
            $user_id = $request->input('user_id');
            $email = $request->input('email');
            
            $query = DB::table('users')
                            ->select('*');
                            if($user_id != ''){
                                $query->where('id','!=',$user_id);
                            }
                    
                            $query->where('email',$email)
                            ->where('role_id','1')
                            ->where('status','1');
                            
            $user_detail = $query->first();     

            if(!empty($user_detail)){
                
                $result['status'] = 1;
                $result['msg'] = "This email is already exist.";
            } else {
                $result['status'] = 0;
                $result['msg'] = "Email available.";
            }
        }
        
        echo  json_encode($result);
        exit;
    }
    
    public function delete(Request $request){
        
        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                DB::table('users')
                        ->where('id', $id)
                        ->update(array('status' => -1));

                $data_result['status'] = 1;
                $data_result['msg'] = "Record deleted successfully.";
            }
        }
        echo json_encode($data_result);
        exit;
    }
    
     public function user_data_table() {

        $requestData = $_REQUEST;

        $data = array();

        //This is for order 
        $columns = array(
            0. => 'u.role_id',
            1 => 'u.name',
            2 => 'u.email',
            3 => 'u.status',
            4 => 'u.created_at',
            5 => 'u.updated_at',
        );

        $select_query = DB::table('users as u')
                ->where('u.status', '!=', -1);

        $select_query->select('u.*', DB::raw("IF(u.status = 1,'Active','Inactive') as status"),DB::raw("IF(u.role_id = 1,'Admin','User') as user_role"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("u.name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("u.role_id", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("u.name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("u.email", "like", '%' . $requestData['search']['value'] . '%');
        }

        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("u.created_at", "DESC");
        }

        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $user_list = $select_query->get();
        
        
        foreach ($user_list as $row) {

            $temp['user_role'] = $row->user_role;
            $temp['name'] = $row->name;
            $temp['email'] = $row->email;
//            $temp['password'] = $row->password;
            $temp['status'] = $row->status;
            $id = $row->id;

            $action = '<div class="datatable_btn" style="display:flex;"><a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-info btnEdit_user"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" type="button" class="btn btn-xs btn-danger btnDelete_user"> Delete</a></div>';


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

    public function check_email(Request $request) {

        $post = $request->input();
        $id = $post['id'];
        $email_id = $post['email'];

        $email = DB::table('users')
                ->select('*')
                ->where('id', '!=', $id)
                ->where('status', '!=', -1)
                ->where('email', '=', $email_id)
                ->get();
        $valid = TRUE;
        $email_all = count($email);

        if ($email_all > 0) {
            $valid = FALSE;
        } else {
            $valid = TRUE;
        }
        return json_encode(array('valid' => $valid));
        exit;
    }
}
