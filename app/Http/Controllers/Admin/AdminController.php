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

        $post = $request->post();
        $data = array();

        if (!empty($post)) {

            $user_data = ([
                'name' => $post['name'],
                'email' => $post['email'],
                'mobile_number' => $post['mobile_number'],
                'password' => Hash::make($post['password']),
                'role_id' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $insert = DB::table('users')->insert($user_data);

            if ($insert) {
                
                $mail_data['name'] = $user_data['name'];
                $mail_data['email'] = $user_data['email'];
                
                Mail::send('admin.signup_mail', $mail_data, function($message) use ($mail_data) {
                    $message->to($mail_data['email'], 'Sign up')->subject
                            ('Sign up');
                    $message->from(USER_EMAIL, USER_NAME);
                });
                
                $data['status'] = 1;
                $data['msg'] = "Sign up successfully.";
            } else {
                $data['status'] = 0;
                $data['msg'] = "Something went wrong try again.";
            }
        }
        echo json_encode($data);
        exit;
    }

    public function validation(Request $request) {

        $post = $request->post();
        $data = array();
        $data['status'] = 0;

        if (!empty($post)) {

            $email = $post['email'];
            $result = DB::table('users')->where('email', $email)->where('role_id', 1)->first();

            if (!empty($result)) {
                $data['status'] = 1;
                $data['msg'] = 'Email already registered.';
            } else {
                $data['status'] = 0;
                $data['msg'] = 'Email dose not exist';
            }
        }
        echo json_encode($data);
        exit;
    }

    public function forgot(Request $request) {
        $post = $request->post();

        $result = array();

        if (!empty($post)) {

            $email = $post['email'];
            $user = DB::table('users')->where('email', $email)->where('role_id', 1)->first();

            if (!empty($user)) {

                $id = $user->id;
                $data = array();
                $data['id'] = base64_encode($id);
                $data['email'] = $user->email;
                $data['name'] = $user->name;
                $data['link'] = url('/forgot/change_password/' . $data['id']);

                Mail::send('admin.mail', $data, function($message) use ($data) {
                    $message->to($data['email'], 'Forgot Password')->subject
                            ('Reset password');
                    $message->from(USER_EMAIL, USER_NAME);
                });

                $result['status'] = 1;
                $result['msg'] = "We send you a link to reset password.";
            } else {
                $result['status'] = 0;
                $result['msg'] = "Email not exist.";
            }
        }

        echo json_encode($result);
        exit;
    }

    public function change_password($id) {

        if ($id != '') {
            $id_decode = base64_decode($id);
            $data['id'] = $id_decode;

            return view('admin.change_password')->with($data);
        }
    }

    public function change(Request $request) {
        $post = $request->post();
        $result = array();
        $result['status'] = 0;

        if (!empty($post)) {

            $password = Hash::make($post['password']);

            $pass_update = DB::table('users')
                    ->where('id', $post['id'])
                    ->where('role_id', 1)
                    ->update(['password' => $password]);

            if ($pass_update) {
                $result['status'] = 1;
                $result['msg'] = 'Password changed. click <a href="'.url('login').'" style="color:#5d5876;">here</a> for login';
            } else {
                $result['status'] = 0;
                $result['msg'] = 'Something went wrong.';
            }
        }

        echo json_encode($result);
        exit;
    }

}
