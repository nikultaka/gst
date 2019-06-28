@extends('Admin.layouts.login.main')

@section('content')
<form id="change_form"  name="change_form" action="" method="post" onsubmit="return false;" >
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id" value="{{$id}}">
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
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Verify</button>
        </div>
    </div>

</form>
@endsection
@section('bottomscript')
<script>
    $(document).ready(function () {
        $.validate({
            form: '#change_form',
            modules: 'security',
            onSuccess: function ($form) {
                var password = $('#password').val();
                var id = $('#id').val();
                $.ajax({
                    url: '<?php echo url('/forgot/change'); ?>',
                    method: 'post',
                    data: $('#change_form').serialize(),
                    success: function (result) {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            $("#change_form")[0].reset();
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