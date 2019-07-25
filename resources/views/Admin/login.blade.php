@extends('Admin.layouts.login_main')

@section('content')
<div class="kt-login__signin">
    <div class="kt-login__head">
        <h3 class="kt-login__title">Sign In </h3>
    </div>
    <form class="kt-form" action="{{ url('/login') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Email" name="email" id="email" autocomplete="off" required="required">
        </div>
        <div class="input-group">
            <input class="form-control" type="password" placeholder="Password" name="password" id="password" required="required">
        </div>
        <div class="row kt-login__extra">
            <!--                                        <div class="col">
                                                        <label class="kt-checkbox">
                                                            <input type="checkbox" name="remember"> Remember me
                                                            <span></span>
                                                        </label>
                                                    </div>-->
            <div class="col kt-align-right">
                <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
            </div>
        </div>
        <div class="kt-login__actions">
            <button type="submit" id="" class="btn btn-brand btn-pill kt-login__btn-primary">Sign In</button>
        </div>
    </form>
</div>
<div class="kt-login__signup">
    <div class="kt-login__head">
        <h3 class="kt-login__title">Sign Up</h3>
        <div class="kt-login__desc">Enter your details to create your account:</div>
    </div>
    <form class="kt-form" id="user_form"  name="user_form" action="" method="post" onsubmit="return false;" >
        {{ csrf_field() }}
        <div class="">
            <input class="form-control" type="text" placeholder="Fullname" id="name" name="name" data-validation="required">
        </div>
        <div class="">
            <input class="form-control" type="text" placeholder="Email" name="email" id="reg_email" autocomplete="off" data-validation="required,email">
        </div>
        <div class="">
            <input class="form-control" type="text" placeholder="Mobile Number" name="mobile_number" id="mobile_number" data-validation="number" data-validation-optional="true">
        </div>
        <div class="">
            <input class="form-control" type="password" placeholder="Password" name="password_confirmation" id="password" data-validation="length" data-validation-length="min6">
        </div>
        <div class="">
            <input class="form-control" type="password" placeholder="Confirm Password" name="password" id="repassword" data-validation="confirmation">
        </div>
        <div class="kt-login__actions">
            <p id="register_msg"></p>
            <button type="submit" id="submit" name="submit"  class="btn btn-brand btn-pill kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;
            <button id="kt_login_signup_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
        </div>
    </form>
</div>
<div class="kt-login__forgot">
    <div class="kt-login__head">
        <h3 class="kt-login__title">Forgotten Password ?</h3>
        <div class="kt-login__desc">Enter your email to reset your password:</div>
    </div>
    <form class="kt-form" id="forgot_form"  name="forgot_form" action="" method="post" onsubmit="return false;">
        {{ csrf_field() }}
        <div class="">
            <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off" data-validation="required,email">
        </div>
        <div class="kt-login__actions">
            <p id="forgot_msg"></p>
            <button type="submit" id="submit" name="submit" class="btn btn-brand btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
            <button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
        </div>
    </form>
</div>
<div class="kt-login__account">
    <span class="kt-login__account-msg">
        Don't have an account yet ?
    </span>
    &nbsp;&nbsp;
    <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
</div>

@endsection

@section('bottomscript')
<script>
    $(document).ready(function () {
        $.validate({
            form: '#user_form',
            modules: 'security',
            onSuccess: function ($form) {
                var fdata = new FormData($("#user_form")[0]);
                $.ajax({
                    url: '<?php echo url('/signup/save'); ?>',
                    method: 'post',
                    data: $('#user_form').serialize(),
                    success: function (result) {

                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            $("#user_form")[0].reset();
                            $("#register_msg").css('color', 'green');
                            $("#register_msg").html(data.msg);
                        } else {
                            $("#register_msg").css('color', 'red');
                            $("#register_msg").html(data.msg);
                        }
                    }
                });
            },
            onValidate: function ($form) {
                var email = $('#reg_email').val();
                var obj = {};
                $.ajax({
                    url: '<?php echo url('/signup/validataion'); ?>',
                    method: 'post',
                    async: false,
                    data: {
                        'email': email,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result.status == 1) {
                            obj.element = $('#reg_email');
                            obj.message = result.msg;
                        }
                    }
                });
                return obj;
            },
        });
    });

    $(document).ready(function () {
        $.validate({
            form: '#forgot_form',
            modules: 'security',
            onSuccess: function ($form) {
//                        var email = $('#email').val();
                $.ajax({
                    url: '<?php echo url('/forgot/verify'); ?>',
                    method: 'post',
                    data: $("#forgot_form").serialize(),
                    success: function (result) {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            $("#forgot_form")[0].reset();
                            $("#forgot_msg").css('color', 'green');
                            $("#forgot_msg").html(data.msg);
                        } else {
                            $("#forgot_msg").css('color', 'red');
                            $("#forgot_msg").html(data.msg);
                        }
                    }
                });
            },
        });
    });
</script>
@endsection