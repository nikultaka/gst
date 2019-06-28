@extends('Admin.layouts.login.main')

@section('content')
<form id="forgot_form"  name="forgot_form" action="" method="post" onsubmit="return false;" >
    {{ csrf_field() }}
    <div class="form-group has-feedback">
        <input type="text" name="email" id="email" class="form-control" data-validation="required,email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <p id="msg"></p>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <a href="{{ url('/login') }}" class="text-center">Remember password ? Log in here.</a>
                </label>
            </div>
        </div>
        <div class="col-xs-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Verify</button>
        </div>
    </div>

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
                    url: '<?php echo url('/forgot/verify'); ?>',
                    method: 'post',
                    data: $("#forgot_form").serialize(),
                    success: function (result) {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            $("#forgot_form")[0].reset();
                            $("#msg").css('color', 'green');
                            $("#msg").html(data.msg);
                        } else {
                            $("#msg").css('color', 'red');
                            $("#msg").html(data.msg);
                        }
                    }
                });
            },
        });
    });
</script>
@endsection