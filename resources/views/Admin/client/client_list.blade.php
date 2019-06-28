@extends('Admin.Newlayout.main')

@section('pageTitle','Clients')
@section('pageHeadTitle','Clients')
@section('content')


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Client Table
                </h3>
            </div>
            <p id="msg_main" style="text-align: center;font-size: 15px;margin-top: 15px;"></p>
            <div class="kt-portlet__head-toolbar">
                <button type="button" class="btn btn-primary btn-sm open-modal" data-toggle="modal" data-target="#ins_client">Create New Client</button>
            </div>

        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped- table-bordered table-hover table-checkable client-table dataTable no-footer dtr-inline" role="grid" aria-describedby="kt_table_1_info" style="width: 1187px;">
                            <thead>
                            <th>User Name</th>
                            <th>Client Name</th>
                            <th>GSTIN</th>
                            <th>Action</th>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>


<!-- Main content -->
<!--<section class="content">
     Small boxes (Stat box) 
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Client List</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info btn-sm open-modal" data-toggle="modal" data-target="#ins_user"> Create New User </button>
                    </div>
                </div>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    <p id="msg_main"></p>
                </div>
                <div class="box-body  table-responsive">
                    <table class="table table-bordered table-striped with-check user-table table-hover" width="100%">
                        <thead>

                        <th>Category</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>status</th>
                        <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>-->
@include('Admin.client.addclient')

@endsection
@section('bottomscript')
<script src="{!! asset(ASSET.'js/Admin/client.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.client.initialize();
    });
</script>  
@endsection