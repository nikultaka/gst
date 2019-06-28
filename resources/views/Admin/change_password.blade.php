@extends('Admin.layouts.login.main')

@section('content')
<form id="change_form"  name="change_form" action="" method="post" onsubmit="return false;" >
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id" value="{{$user->id}}">
    <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" id="password" data-validation="length" data-validation-length="min3" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password" id="repassword" data-validation="confirmation" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <!--        <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <a href="<?php echo url('/'); ?>/login" class="text-center">I already have a membership</a>
                        </label>
                        <label>
                            <a href="<?php echo url('/'); ?>/signup" class="text-center">Register a new membership</a>
                        </label>
                    </div>
                </div>-->
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
            form: '#change_form',
            modules: 'security',
            onSuccess: function ($form) {
                var password = $('#password').val();
                var id = $('#id').val();
                $.ajax({
                    url: '<?php echo url('/'); ?>/forgot/change',
                    method: 'post',
                    data: {
                        'id': id,
                        'password': password,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        window.location.href = '<?php echo url('/'); ?>/dashboard';
                    }
                });
            },
        });
    });
</script>
@endsection