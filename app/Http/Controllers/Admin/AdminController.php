<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;

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

}
