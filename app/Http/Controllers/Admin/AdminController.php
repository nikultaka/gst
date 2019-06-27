<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Mail;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {

    public function login(Request $request) {
        $username = $request->input('email');
        $password = $request->input('password');


        if (Auth::attempt(['email' => $username, 'password' => $password, 'role_id' => 1])) {
            return Redirect::intended('dashboard');
        }

        return Redirect::back()
                        ->withInput()
                        ->withErrors('That username/password combo does not exist.');
    }

    public function signup(Request $request) {
        $user_data = ([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => 1,
            'status' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert($user_data);
        $data['status'] = 1;
        $data['console'] = $user_data['name'];
        echo json_encode($data);
        exit;
    }

    public function validation(Request $request) {
        $email = $request->post();
        $result = DB::table('users')->where('email', $email)->first();
        if (!empty($result)) {
            $data['status'] = 0;
            $data['msg'] = 'We have sent a verification link please click for change your password';
        } else {
            $data['status'] = 1;
            $data['msg'] = 'Email dose not exist';
        }
        echo json_encode($data);
        exit;
    }

    public function forgot(Request $request) {
        $array = $request->post();
        $email = $array['email'];
        $data['email'] = $email;
        $result = DB::table('users')->where('email', $email)->first();
        $set = $result->id;
        $code = array('code' => base64_encode($set));
        Mail::send('admin.mail', $code, function($message) use ($data) {
            $message->to($data['email'], 'Forgot Password')->subject
                    ('Verification mail to change password');
            $message->from(USER_EMAIL, USER_NAME);
        });
        echo "HTML Email Sent. Check your inbox.";
    }

    public function change_password($code) {
        $code = request()->segment(3);
        $id = base64_decode($code);
        $result = DB::table('users')->where('id', $id)->first();
        $data['user'] = $result;
        if (!empty($result)) {
            return view('admin.change_password')->with($data);
        } else {
            echo "Code dose not match";
            exit;
        }
    }

    public function change(Request $request) {
        $array = $request->post();
        $password = Hash::make($array['password']);

        DB::table('users')
                ->where('id', $array['id'])
                ->update(['password' => $password]);
    }

}
