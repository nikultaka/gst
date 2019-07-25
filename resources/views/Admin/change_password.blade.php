@extends('Admin.layouts.login_main')

@section('content')
<div class="kt-login__signin">
    <div class="kt-login__head">
        <h3 class="kt-login__title">Change Password </h3>
    </div>
    <form class="kt-form" id="change_form"  name="change_form" action="" method="post" onsubmit="return false;">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="{{$id}}">
        <div class="">
            <input class="form-control" type="password" placeholder="Password" name="password_confirmation" id="password" data-validation="length" data-validation-length="min6" autocomplete="off">
        </div>
        <div class="">
            <input class="form-control" type="password" placeholder="Confirm password" name="password" id="password" data-validation="confirmation">
        </div>

        <div class="kt-login__actions">
            <p id="msg"></p>
            <button type="submit" id="submit" name="submit" class="btn btn-brand btn-pill kt-login__btn-primary">Submit</button>
        </div>
    </form>
</div>

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