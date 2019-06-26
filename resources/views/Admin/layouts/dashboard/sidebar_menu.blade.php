<?php
$session = Session::get('platform_id');
$reporting = Session::get('reporting');
?>
<style>
    .platfrom_selected{
        color: #fff;
        background:black;
    }
</style>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset(ASSET.'dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>

            </div>
        </div>
        <!-- search form -->
        <!--      <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </span>
                </div>
              </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>


            <li><a href="{{url('dashboard')}}" class="sidebar_platform <?php if(isset($session) && $session == 1) { echo 'platfrom_selected'; } ?>" data-id="1"><i class="fa fa-circle-o"></i> <span>Amazon B2C</span></a></li>
            <li><a href="javascript:void(0);" class="sidebar_platform <?php if(isset($session) && $session == 2) { echo 'platfrom_selected'; } ?>" data-id="2"><i class="fa fa-circle-o"></i> <span>Amazon B2B</span></a></li>
            <li><a href="javascript:void(0);" class="sidebar_platform <?php if(isset($session) && $session == 3) { echo 'platfrom_selected'; } ?>" data-id="3"><i class="fa fa-circle-o"></i> <span>Flipkart</span></a></li>
            <li><a href="javascript:void(0);" class="sidebar_platform <?php if(isset($session) && $session == 4) { echo 'platfrom_selected'; } ?>" data-id="4"><i class="fa fa-circle-o"></i> <span>Snapdeal</span></a></li>
            <li><a href="javascript:void(0);" class="sidebar_platform <?php if(isset($session) && $session == 5) { echo 'platfrom_selected'; } ?>" data-id="5"><i class="fa fa-circle-o"></i> <span>PayTm</span></a></li>
            <!--<li><a href="{{url('reporting')}}" class="sidebar_platform <?php // if(isset($session) && $session == 6) { echo 'platfrom_selected'; } ?>" data-id="6"><i class="fa fa-circle-o"></i> <span>Reporting</span></a></li>-->
            <li><a href="{{url('reporting')}}" class="<?php if(isset($reporting) && $reporting == 1) { echo 'platfrom_selected'; } ?>"><i class="fa fa-circle-o"></i> <span>Reporting</span></a></li>

        <!--<li><a href="{{ url(ADMIN_LOGOUT)}}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>-->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>