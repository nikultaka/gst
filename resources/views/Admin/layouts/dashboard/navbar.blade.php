
<header class="main-header">
    <!-- Logo -->
    <a href="{{url(ADMIN.'/dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Logo</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <!--<b>Logo</b>-->
            <img src="{{asset(ASSET.'new_frontend/img/logo-white.png')}}" class="img-circle" alt="User Image" height="50px;">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu" style="margin-right: 50px;width: 80%;">
            <ul class="nav navbar-nav" style="width: 100%;">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" style="width: 100%;margin-top: 15px;">
                    <!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                            <span class="hidden-xs"></span>
                                        </a>-->
                    <ul class="dropdown-menu" style="width: 100%;"> 
                        <!-- User image -->
                        <li class="user-header">
          <!--                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">-->

                            <p>

                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url(ADMIN_LOGOUT)}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-sm-3">
                            <select class="form-control select_dropdown" id="client_name" name="client_name">
                                <option value="">Client Name</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control select_dropdown" id="financial_year" name="financial_year">
                                <option value="">Financial Year</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="month_quarter_div">
                                <select class="form-control select_dropdown" id="month_quarter" name="month_quarter">
                                    <option value="">Month/Quarter</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control select_dropdown" id="select_type" name="select_type">
                                <!--<option value="">Select Type</option>-->
                                <option value="0">Original</option>
                                <option value="1">Revision 1</option>
                                <option value="2">Revision 2</option>
                            </select>
                        </div>
                    </div>
                </li>

                <!-- Control Sidebar Toggle Button -->
                <!--                <li>
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                </li>-->
            </ul>
        </div>
    </nav>
</header>