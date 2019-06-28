@extends('Admin.layouts.login.main')

@section('content')

<form role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
      <!--<input type="email" class="form-control">-->
        <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Email" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <!--<input type="password" class="form-control" >-->
        <input id="password" type="password" placeholder="Password" class="form-control" name="password" placeholder="Password" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="checkbox icheck">
                <label>
                    <a href="{{ url('/signup') }}" class="text-center">Dont't have an account! Register here.</a>
                </label>
                <label>
                    <a href="{{ url('/forgot') }}" class="text-center">Forgot Password ?</a>
                </label>
            </div>
        </div>
        <!--      <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox"> Remember Me
                  </label>
                </div>
              </div>-->
        <!-- /.col -->
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<!--<div class="social-auth-links text-center">
  <p>- OR -</p>
  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
    Facebook</a>
  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
    Google+</a>
</div>-->
<!-- /.social-auth-links -->

<!--<a href="{{ url('/password/reset') }}">Forgotten Password?</a><br>
<a href="#" class="text-center">Register a new membership</a>
-->


@endsection