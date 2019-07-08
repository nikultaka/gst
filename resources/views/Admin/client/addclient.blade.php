<!--        modal-->
<form class="form-horizontal" id="frm_client" name="frm_client" action="" method="post" onsubmit="return false;">
    <div class="modal fade" id="ins_client" role="dialog">
        <div class="modal-dialog">
            <input type="hidden" id="client_id" name="client_id" value="">
            <!--modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create new Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <p id="msg"></p>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="user_id" class="col-sm-3 control-label" >User</label>
                            <div class="col-sm-9">
                                <select id="user_id" name="user_id" class="form-control" data-validation="required">
                                    <option value="">----Select User----</option>
                                    <?php
                                    if (!empty($users)) {
                                        foreach ($users as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_name" class="col-sm-3 control-label">Client Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="cl_name" id="cl_name" data-validation="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gstin" class="col-sm-3 control-label">GSTIN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="gstin" id="gstin" data-validation="required" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary sub_user" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

