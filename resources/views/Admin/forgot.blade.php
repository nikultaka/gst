@extends('Admin.layouts.login.main')

@section('content')
<form id="forgot_form"  name="forgot_form" action="" method="post" onsubmit="return false;" >
    {{ csrf_field() }}
    <div class="form-group has-feedback">
        <input type="text" name="email" id="email" class="form-control" data-validation="email" required="required" placeholder="E-Mail id">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <a href="<?php echo url('/'); ?>/login" class="text-center">I already have a membership</a>
                </label>
                <label>
                    <a href="<?php echo url('/'); ?>/signup" class="text-center">Register a new membership</a>
                </label>
            </div>
        </div>
        <div class="col-xs-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Verify</button>
        </div>
    </div>
    <p id="msg"></p>
</form>
@endsection
@section('bottomscript')
<script>
    $(document).ready(function () {
        $.validate({
            form: '#forgot_form',
            modules: 'security',
            onSuccess: function ($form) {
                var email = $('#email').val();
                $.ajax({
                    url: '<?php echo url('/'); ?>/forgot/verify',
                    method: 'post',
                    data: {
                        'email': email,
                        "_token": "{{ csrf_token() }}",
                    },
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
                        if (result.status == 1) {
                            obj.element = $('#email');
                            obj.message = 'Email dose not exist.';
                        }
                        else{
                            $("#msg").html(result.msg);
//                            obj.message = 'We have sent a verification link please click for change your password';
                        }
                    }
                });
                return obj;
            },
        });
    });
</script>
@endsection