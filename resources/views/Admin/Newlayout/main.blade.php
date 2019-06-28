<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

    <!-- begin::Head -->
    <head>

        <!--begin::Base Path (base relative path for assets of this page) -->
        <base href="../">

        <!--end::Base Path -->
        <meta charset="utf-8" />
        <title>Metronic | Dashboard</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                },
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <style>
            .loader {
                display: none;
                background-color: rgba(255,255,255,0.3);
                position: absolute;
                z-index: 1000 !important;
                width: 100%;
                height:100%;
            }

            .loader img {
                position: relative;
                top:50%;
                left:50%;
            }
        </style>
        <script type="text/javascript">
            var admin = {};
            var BASE_URL = "{{ url('/') }}";
            var ADMIN = "{{ ADMIN }}";
            var ASSET = "{{ ASSET }}";
        </script>

        <!--end::Fonts -->

        <!--begin::Page Vendors Styles(used by this page) -->

        <link href="{{asset(ASSET.'assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />

        <!--end::Page Vendors Styles -->

        <!--begin:: Global Mandatory Vendors -->
        <link href="{{asset(ASSET.'assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

        <!--end:: Global Mandatory Vendors -->

        <!--begin:: Global Optional Vendors -->
        <link href="{{asset(ASSET.'assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset(ASSET.'assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

        <!--end:: Global Optional Vendors -->

        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{asset(ASSET.'assets/css/demo3/style.bundle.css')}}" rel="stylesheet" type="text/css" />

        <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->

        <!--end::Layout Skins -->

        <link rel="stylesheet" href="{{asset(ASSET.'css/jquery.dataTables.min.css')}}">

        <script src="{{asset(ASSET.'assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>

        <link rel="shortcut icon" href="{{asset(ASSET.'assets/media/logos/favicon.ico')}}" />
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
        <div class="loader">
            <img src="{{asset(ASSET.'upload/loader.gif')}}">
        </div>

        <input type="hidden" value="{{ csrf_token() }}" name='csrf-token' id='csrf-token'>
        <!-- begin:: Page -->

        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="{{url('/')}}">
                    <img alt="Logo" src="{{asset(ASSET.'assets/media/logos/logo-2-sm.png')}}" />
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>

        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">


                @include('Admin.Newlayout.sidebar_menu')


                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    <!-- begin:: Header -->
                    @include('Admin.Newlayout.navbar')

                    <!-- end:: Header -->
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                        <!-- begin:: Content Head -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-subheader__main" style="width: 100%;">
                                <!--                                <h3 class="kt-subheader__title">Dashboard</h3>
                                                                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                                                <span class="kt-subheader__desc">#XRS-45670</span>
                                                                <a href="#" class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">
                                                                    Add New
                                                                </a>
                                                                <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                                                                    <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
                                                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span><i class="flaticon2-search-1"></i></span>
                                                                    </span>
                                                                </div>-->

                                <div class="row" style="width: 100%;"> 
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
                            </div>
                        </div>

                        <!-- end:: Content Head -->

                        <!-- begin:: Content -->

                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                            @yield('content')			
                        </div>

                        <!-- end:: Content -->

                        <!-- end:: Content -->
                    </div>

                    <!-- begin:: Footer -->
                    <div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-footer__copyright">
                            <!--2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>-->
                        </div>
                        <div class="kt-footer__menu">
                            <!--                            <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                                                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                                                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>-->
                        </div>
                    </div>

                    <!-- end:: Footer -->
                </div>
            </div>
        </div>

        <!-- end:: Page -->

        <!-- begin::Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>



        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#2c77f4",
                        "light": "#ffffff",
                        "dark": "#282a3c",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>

        <!-- end::Global Config -->

        <!--begin:: Global Mandatory Vendors -->
<!--        <script src="{{asset(ASSET.'assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>-->
        <script src="{{asset(ASSET.'assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>

        <!--end:: Global Mandatory Vendors -->

        <!--begin:: Global Optional Vendors -->
        <script src="{{asset(ASSET.'assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/bootstrap-switch.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/nouislider/distribute/nouislider.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/markdown/lib/markdown.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/bootstrap-markdown.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/bootstrap-notify.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/jquery-validation.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/raphael/raphael.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/morris.js/morris.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/counterup/jquery.counterup.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/js/vendors/sweetalert2.init.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/general/dompurify/dist/purify.js')}}" type="text/javascript"></script>

        <!--end:: Global Optional Vendors -->

        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="{{asset(ASSET.'assets/js/demo3/scripts.bundle.js')}}" type="text/javascript"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Vendors(used by this page) -->
        <script src="{{asset(ASSET.'assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
        <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
        <script src="{{asset(ASSET.'assets/vendors/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>

        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        <script src="{{asset(ASSET.'assets/js/demo3/pages/dashboard.js')}}" type="text/javascript"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

        <script src="{{asset(ASSET.'bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <!--end::Page Scripts -->

        <script src="{{asset(ASSET.'js/common.js')}}"></script>
        <script src="{{asset(ASSET.'js/Admin/dashboard.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                admin.common.initialize();
                admin.dashboard.initialize();
                admin.dashboard.initialize();
            });
        </script>
        @yield('bottomscript')
    </body>

    <!-- end::Body -->
</html>