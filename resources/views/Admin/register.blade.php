@extends('Admin.layouts.login.main')

@section('content')
<form id="user_form"  name="user_form" action="" method="post" onsubmit="return false;" >
    {{ csrf_field() }}
    <input type="hidden" id="id" name="id"/>
    <div class="form-group has-feedback">
        <input type="text" id="name" name="name" class="form-control" data-validation="required" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="text" name="email" id="email" class="form-control" data-validation="required,email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" id="password" data-validation="length" data-validation-length="min6" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password" id="repassword" data-validation="confirmation" class="form-control" placeholder="Confirm password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <p id="msg"></p>
    <div class="row">
        <div class="col-xs-12">
            <div class="checkbox icheck">
                <label>
                    <a href="{{ url('/login') }}" class="text-center">Already have an account Log in here.</a>
                </label>
            </div>
        </div>
        <div class="col-xs-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
    </div>
    
</form>
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
                        if(data.status == 1){
                            $("#user_form")[0].reset();
                            $("#msg").css('color','green');
                            $("#msg").html(data.msg);
                        } else {
                            $("#msg").css('color','red');
                            $("#msg").html(data.msg);
                        }
                    }
                });
            },
            onValidate: function ($form) {
                var email = $('#email').val();
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
                            obj.element = $('#email');
                            obj.message = result.msg;
                        }
                    }
                });
                return obj;
            },
        });
    });
</script>
@endsection