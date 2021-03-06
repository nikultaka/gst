
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item <?php
                if (\Request::is('dashboard')) {
                    echo "kt-menu__item--active";
                }
                ?> " aria-haspopup="true">
                    <a href="{{url('dashboard')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-text">Dashboard</span>
                    </a>
                </li>
                <li class="kt-menu__item <?php
                if (\Request::is('reporting')) {
                    echo "kt-menu__item--active";
                }
                ?>" aria-haspopup="true">
                    <a href="{{url('reporting')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-text">Reports</span>
                    </a>
                </li>
                <li class="kt-menu__item <?php
                if (\Request::is('clients')) {
                    echo "kt-menu__item--active";
                }
                ?>" aria-haspopup="true">
                    <a href="{{url('clients')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-text">Clients</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>



    <div class="kt-header__topbar">

        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" >
                <div class="kt-header__topbar-user">

                    <a href="{{url('logout')}}" class="kt-menu__link ">
                        <span class="kt-badge kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder" style="width: 70px;">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>