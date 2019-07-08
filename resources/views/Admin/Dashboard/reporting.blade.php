@extends('Admin.Newlayout.main')

@section('pageTitle','Report')
@section('pageHeadTitle','Report')
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
                    Sales Report
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
<!--                        <table class="table table-bordered table-striped with-check sales-table table-hover" style="width: 100%;">-->
                        <table class="table table-striped- table-bordered table-hover table-checkable reporting-table dataTable no-footer dtr-inline" role="grid" aria-describedby="kt_table_1_info" style="width: 1187px;">
                        <!--<table class="table table-bordered table-striped with-check reporting-table table-hover" style="width: 100%;">-->
                            <thead>
                            <th>Place of supply</th>
                            <th>Tax Rate(%)</th>
                            <th>Total Taxable Amount</th>
                            <th>IGST</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>Total</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total:</th>
                                    <th style="background-color: yellow;"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>

            </div>
            <!--end: Datatable -->
        </div>
    </div>


<!--    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Sales Return Report
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            begin: Datatable 
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped with-check sales-return-table table-hover" style="width: 100%;">
                        <table class="table table-striped- table-bordered table-hover table-checkable reporting-sales-table dataTable no-footer dtr-inline" role="grid" aria-describedby="kt_table_1_info" style="width: 1187px;">
                        <table class="table table-bordered table-striped with-check reporting-sales-table table-hover" style="width: 100%;">
                            <thead>
                            <th>Place of supply</th>
                            <th>Tax Rate(%)</th>
                            <th>Total Taxable Amount</th>
                            <th>IGST</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>Total</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total:</th>
                                    <th style="background-color: yellow;"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>

            </div>
            end: Datatable 
        </div>
    </div>-->



</div>
<!-- end:: Content -->	


@endsection
@section('bottomscript')
<script src="{!! asset(ASSET.'js/Admin/show_tables.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.table.initialize();
    });
</script>  
@endsection