admin.client = {
    initialize: function ()
    {
        var this_class = this;

        $('body').on('click', '.btnEdit_client', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        $('body').on('click', '.btnDelete_client', function () {
            var user_id = $(this).data('id');
            this_class.delete_row(user_id);
        });

        admin.client.load_client();

        admin.client.refresh_validator();

        $('#ins_client').on('hidden.bs.modal', function () {
            $('#frm_client')[0].reset();
            $('#client_id').val('');
        });

    },
    load_client: function () {

        var table = jQuery('.client-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [],
            ajax: {
                url: BASE_URL + '/clients/gettable',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'client_name', name: 'client_name'},
                {data: 'gstin', name: 'gstin'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

    },
    refresh_validator: function () {

        $.validate({
            form: '#frm_client',
            onSuccess: function () {
                $.ajax({
                    url: BASE_URL + '/clients/add',
                    type: 'POST',
                    data: $('#frm_client').serialize(),
                    datatype: 'json',
                    success: function (data) {
                        var data = $.parseJSON(data);
                        if (data.status == 1) {
                            $('#msg_main').css('color', 'green');
                            $('#msg_main').html(data.msg);
                            $('#frm_client')[0].reset()
                            admin.client.load_client();
                        } else {
                            $('#msg_main').css('color', 'red');
                            $('#msg_main').html(data.msg);
                        }
                        $("#ins_client").modal("hide");
                    }
                });
            },
        });
    },
    edit_row: function (id) {

        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/clients/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {

                        $("#client_id").val(data.content.id);
                        $("#user_id").val(data.content.user_id);
                        $("#cl_name").val(data.content.client_name);
                        $("#gstin").val(data.content.gstin);

                        $("#ins_client").modal("show");
                    }
                }
            });
        }
        else {
            return false;
        }
    },
    delete_row: function (id) {

        if (id > 0) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: BASE_URL + '/clients/delete',
                    type: 'POST',
                    data: {_token: admin.common.get_csrf_token_value(), id: id},
                    success: function (data) {
                        var data = $.parseJSON(data);
                        if (data.status == 1) {
                            $('#msg_main').css('color', 'green');
                            $('#msg_main').html(data.msg);
                            admin.client.load_client();
                        } else {
                            $('#msg_main').css('color', 'red');
                            $('#msg_main').html(data.msg);
                        }
                    }
                });
            }
        }
        else {
            return false;
        }


    },
};