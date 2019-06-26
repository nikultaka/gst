@extends('Admin.Newlayout.main')

@section('pageTitle','Table List')
@section('pageHeadTitle','Table List')
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
                    Sales Table
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped- table-bordered table-hover table-checkable sales-table dataTable no-footer dtr-inline" role="grid" aria-describedby="kt_table_1_info" style="width: 1187px;">
                            <thead>
                            <th>Date</th>
                            <th>Invoice Number</th>
                            <th>Place of Supply</th>
                            <th>Taxable Amount</th>
                            <th>GST Rate</th>
                            <th>HSN/SAC</th>
                            <th>IGST</th>
                            <th>SGST</th>
                            <th>CGST</th>
                            <th>Gross Total</th>
                            <th>Round Off</th>
                            <th>Invoice Amount</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total:</th>
                                    <th style="background-color: yellow;"></th>
                                    <th style="background-color: yellow;"></th>
                                    <th></th>
                                    <th style="background-color: yellow;"></th>
                                    <th style="background-color: yellow;"></th>
                                    <th></th>
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


    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Sales Return Table
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped- table-bordered table-hover table-checkable sales-return-table dataTable no-footer dtr-inline" role="grid" aria-describedby="kt_table_1_info" style="width: 1187px;">
                            <thead>
                            <th>Date</th>
                            <th>Invoice Number</th>
                            <th>Place of Supply</th>
                            <th>Taxable Amount</th>
                            <th>GST Rate</th>
                            <th>HSN/SAC</th>
                            <th>IGST</th>
                            <th>SGST</th>
                            <th>CGST</th>
                            <th>Gross Total</th>
                            <th>Round Off</th>
                            <th>Invoice Amount</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total:</th>
                                    <th style="background-color: yellow;"></th>
                                    <th style="background-color: yellow;"></th>
                                    <th></th>
                                    <th style="background-color: yellow;"></th>
                                    <th style="background-color: yellow;"></th>
                                    <th></th>
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



</div>
<!-- end:: Content -->	
<!-- Main content -->


@endsection
@section('bottomscript')
<script src="{!! asset(ASSET.'js/Admin/show_tables.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.table.initialize();
    });
</script>  
@endsection