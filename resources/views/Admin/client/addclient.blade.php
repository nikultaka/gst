@extends('Admin.Newlayout.main')

@section('pageTitle','Add Clients')
@section('pageHeadTitle','Add Clients')
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
                    
                    <?php 
                        if(isset($client->id) && $client->id != ""){
                            echo "Edit Client";
                        } else {
                            echo "Add Client";
                        }
                    ?>
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{url('clients')}}" type="button" class="btn btn-primary btn-sm open-modal" >Client List</a>
            </div>

        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">


                    <!-- begin:: Content -->
                    <!--<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">-->
                    <div class="row">
                        <div class="col-lg-12">

                            <!--begin::Portlet-->
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            <?php 
                                            if(isset($client->id) && $client->id != ""){
                                                echo "Edit Client Form";
                                            } else {
                                                echo "Add Client Form";
                                            }?>
                                        </h3>
                                    </div>
                                </div>

                                <!--begin::Form-->
                                <form class="form-horizontal kt-form" id="frm_client" name="frm_client" action="" method="post" onsubmit="return false;">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="client_id" name="client_id" value="<?php echo isset($client->id) ? $client->id : ""; ?>">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Client Name :</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="cl_name" id="cl_name" data-validation="required,length" data-validation-length="max100" value="<?php echo isset($client->client_name) ? $client->client_name : ""; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">GSTIN :</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="gstin" id="gstin" data-validation="required" value="<?php echo isset($client->gstin) ? $client->gstin : ""; ?>" onkeyup="this.value = this.value.toUpperCase();"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Years :</label>
                                                    <div class="col-lg-6">
                                                        <?php
                                                        if (!empty($years)) {
                                                            foreach ($years as $key => $value) {
                                                                ?>
                                                                <div class="form-group">
                                                                    <div class="kt-radio-inline">
                                                                        <p><b><?php echo $value; ?></b>
                                                                            <label class="kt-radio" style="margin-left: 50px;">
                                                                                <input type="radio" name="years_<?php echo $key; ?>" value="<?php echo $value; ?>/M" id="yearsm_<?php echo $key; ?>"
                                                                                       <?php if(in_array($value.'/M', $client_years)){
                                                                                           echo "checked='checked'";
                                                                                       }?>> Monthly
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="kt-radio">
                                                                                <input type="radio" name="years_<?php echo $key; ?>" value="<?php echo $value; ?>/Q" id="yearsq_<?php echo $key; ?>"
                                                                                       <?php if(in_array($value.'/Q', $client_years)){
                                                                                           echo "checked='checked'";
                                                                                       }?>> Quarterly
                                                                                <span></span>
                                                                            </label>
                                                                           
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <input type="hidden" id="hidden-radio" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="msg_main" style="text-align: center;"></p>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <button type="submit" class="btn btn-success sub_user">Submit</button>
                                                    <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!--end::Form-->
                            </div>

                        </div>

                    </div>
                    <!--</div>-->

                    <!-- end:: Content -->
                </div>


            </div>
        </div>
    </div>
</div>



@endsection
@section('bottomscript')
<script src="{!! asset(ASSET.'js/Admin/client.js')!!}"></script>
<script type="text/javascript">
                                                            $(document).ready(function () {
                                                                admin.client.initialize();
                                                            });
</script>  
@endsection
