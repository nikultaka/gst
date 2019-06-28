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
        <input type="text" name="email" id="email" class="form-control" data-validation="required" placeholder="E-Mail id" data-validation-url="/validateinput.php">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" id="password" data-validation="length" data-validation-length="min3" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password" id="repassword" data-validation="confirmation" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <a href="<?php echo url('/'); ?>/login" class="text-center">I already have a membership</a>
                </label>
                <label>
                    <a href="<?php echo url('/'); ?>/forgot" class="text-center">Forgot Password</a>
                </label>
            </div>
        </div>
        <div class="col-xs-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
    </div>
    <p id="msg"></p>
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
                    url: '<?php echo url('/'); ?>/signup/save',
                    method: 'post',
                    data: fdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        window.location.href = '<?php echo url('/'); ?>/dashboard';
                    }
                });
            },
            onValidate: function ($form) {
                var email = $('#email').val();
                var obj = {};
                $.ajax({
                    url: '<?php echo url('/'); ?>/signup/validataion',
                    method: 'post',
                    async: false,
                    data: {
                        'email': email,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result.status == 0) {
                            obj.element = $('#email');
                            obj.message = 'Email already exist.';
                        }
                    }
                });
                return obj;
            },
        });
    });
</script>
@endsection