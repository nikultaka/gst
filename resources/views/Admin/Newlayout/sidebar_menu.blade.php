<?php
$session = Session::get('platform_id');
$reporting = Session::get('reporting');
?>
<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{url('/')}}">
                <img alt="Logo" src="{{asset(ASSET.'assets/media/logos/logo-4.png')}}" />
            </a>
        </div>
    </div>

    <!-- end:: Aside -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item sidebar_platform <?php
                if (isset($session) && $session == 1) {
                    echo 'kt-menu__item--active';
                }
                ?>" aria-haspopup="true" data-id="1">
                    <a href="javascript:void(0);" class="kt-menu__link">
                        <i class="kt-menu__link-icon flaticon2-gear"></i>
                        <span class="kt-menu__link-text" style="text-align: center;">Amazon B2C</span>
                    </a>
                </li>
                <li class="kt-menu__item sidebar_platform <?php
                    if (isset($session) && $session == 2) {
                        echo 'kt-menu__item--active';
                    }
                    ?>" aria-haspopup="true" data-id="2">
                    <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-menu__link-icon flaticon2-layers-1"></i>
                        <span class="kt-menu__link-text">Amazon B2B</span>
                    </a>
                </li>
                <li class="kt-menu__item sidebar_platform <?php
                    if (isset($session) && $session == 3) {
                        echo 'kt-menu__item--active';
                    }
                    ?>" aria-haspopup="true" data-id="3">
                    <a href="javascript:void(0);" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-graph"></i>
                        <span class="kt-menu__link-text">Flipkart</span>
                    </a>
                </li>
                <li class="kt-menu__item sidebar_platform <?php
                    if (isset($session) && $session == 4) {
                        echo 'kt-menu__item--active';
                    }
                    ?>" aria-haspopup="true" data-id="4">
                    <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-menu__link-icon flaticon2-drop"></i>
                        <span class="kt-menu__link-text">Snapdeal</span>
                    </a>
                </li>
                <li class="kt-menu__item sidebar_platform <?php
                    if (isset($session) && $session == 5) {
                        echo 'kt-menu__item--active';
                    }
                    ?>" aria-haspopup="true" data-id="5">
                    <a href="javascript:void(0);" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-analytics-2"></i>
                        <span class="kt-menu__link-text">PayTm</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->

</div>
<!-- end:: Aside -->