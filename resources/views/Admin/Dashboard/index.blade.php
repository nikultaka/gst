@extends('Admin.Newlayout.main')

@section('pageTitle','Dashboard')
@section('pageHeadTitle','Dashboard')
@section('content')


<style>
    .show_row tr{
        line-height: 14px;
    }
    table th, table td{
        padding: 10px;
    }
</style>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Upload File
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a  href="{{url('/tablelist')}}" class="btn btn-primary" name="show_data" id="show_data">Show Data</a>
            </div>

        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="col-sm-9">
                            <form action="" method="post" id="upload_form" name="upload_form" enctype="multipart/form-data" onsubmit="return false;">
                                {{ csrf_field() }}
                                <div style="display: flex;">
                                    <div>
                                        <input type="file" name="upload_file" id="upload_file" accept=".csv">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" name="upload" id="upload">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="error_div" style="padding: 20px;">
                            <div id="error_msg"></div>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <div class="error_div" style="padding: 20px; display: none;">
                            <p style="font-size: 20px;font-weight: 500;">Nothing has been imported. Please remove below errors and then upload file again.</p>
                            <div id="msg"></div>
                        </div>

                        <div class="success_div" style="padding: 20px;">
                            <div id="success_msg"></div>
                        </div>



                        <div class="content_div" style="padding: 20px;display: none;">
                            <h3>This rows are out of Month/Quarter.</h3>
                            <div id="content_div" style="width: 100%;overflow: auto;height: 550px;"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end: Datatable -->
        </div>
    </div>



</div>
<!-- end:: Content -->	
<!-- Main content -->



<!-- Main content -->
<!--<section class="content">
    <style>
        .show_row tr{
            line-height: 14px;
        }
        table th, table td{
            padding: 10px;
        }
    </style>
     Small boxes (Stat box) 
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                                        <h3 class="box-title">Title here</h3>
                    <div class="row">
                        <div class="col-sm-9">
                            <form action="" method="post" id="upload_form" name="upload_form" enctype="multipart/form-data" onsubmit="return false;">
                                {{ csrf_field() }}
                                <div style="display: flex;">
                                    <div>
                                        <input type="file" name="upload_file" id="upload_file" accept=".csv">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" name="upload" id="upload">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <div style="float: right;">
                                <a  href="{{url('/tablelist')}}" class="btn btn-primary" name="show_data" id="show_data">Show Data</a>
                            </div>
                        </div>
                        <div class="error_div" style="padding: 20px;">
                            <div id="error_msg"></div>
                        </div>

                    </div>

                </div>
                <div class="box-body">
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
                                                        <option value="">Select Type</option>
                                                        <option value="0">Original</option>
                                                        <option value="1">Revision 1</option>
                                                        <option value="2">Revision 2</option>
                                                    </select>
                                                </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="error_div" style="padding: 20px; display: none;">
                            <p style="font-size: 20px;font-weight: 500;">Nothing has been imported. Please remove below errors and then upload file again.</p>
                            <div id="msg"></div>
                        </div>

                        <div class="success_div" style="padding: 20px;">
                            <div id="success_msg"></div>
                        </div>



                        <div class="content_div" style="padding: 20px;display: none;">
                            <h3>This rows are out of Month/Quarter.</h3>
                            <div id="content_div" style="width: 100%;overflow: auto;height: 550px;"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>-->
<!-- /.content -->
@endsection
@section('bottomscript')
<!--<script src="{!! asset(ASSET.'js/Admin/dashboard.js')!!}"></script>
<script type="text/javascript">
                                $(document).ready(function () {
                                    admin.dashboard.initialize();
                                });
</script>  -->
@endsection
