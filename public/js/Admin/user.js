admin.user = {
    initialize: function ()
    {
        var this_class = this;
        
        $('body').on('click', '.btnEdit_user', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        $('body').on('click', '.btnDelete_user', function () {
            var user_id = $(this).data('id');
            this_class.delete_row(user_id);
        });

        admin.user.load_user();

        admin.user.refresh_validator();

        $('#ins_user').on('hidden.bs.modal', function () {
            $('#frm_user')[0].reset();
            $('#user_id').val('');
        });

    },
    load_user: function () {

        var table = jQuery('.user-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [],
            ajax: {
                url: BASE_URL +'/'+ ADMIN+'/user/gettable',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'user_role', name: 'user_role'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
//                {data: 'password', name: 'password'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

    },
    refresh_validator: function () {
        
        $.validate({
            form : '#frm_user',
             onSuccess : function() {
                    $.ajax({
                            url: BASE_URL + '/'+ADMIN+'/user/add',
                            type: 'POST',
                            data: $('#frm_user').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                var data = $.parseJSON(data);
                                if (data.status == 1) {
                                    $('.alert').show();
                                    $("#ins_user").modal("hide");
                                    $('#msg_main').html(data.msg);
                                    //$('#msg_main').attr('style', 'color:green;');
                                    $('#frm_user')[0].reset()
                                    admin.user.load_user();
                                }
                                else {
                                    return false;
                                }
                            }
                        });
            },
            onValidate : function($form) {

                var obj = {};
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + '/'+ADMIN+ '/email_check',
                    async: false,  
                    data: {user_id : $('#user_id').val(),email : $('#email').val() , '_token' : admin.common.get_csrf_token_value() },
                    success: function (data) {
                        var data = $.parseJSON(data);
                        if (data.status == 1) {
                            obj.element = $('#email');
                            obj.message = 'This Email already exist.';
                        }
                    }
                });
                return obj;
            }
          });
    },
    edit_row: function (id) {


        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/'+ADMIN+ '/user/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {

                        $("#user_id").val(data.content.id);
                        $("#u_name").val(data.content.name);
                        $("#email").val(data.content.email);
                        $("#password").val(data.content.password);

                        var role_name = $("#role_name").val(data.content.role_id);
                        role_name.attr("selected", "selected");

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected", "selected");
                        $("#ins_user").modal("show");
                       // admin.user.load_user();
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
                        url: BASE_URL +  '/'+ADMIN+ '/user/delete',
                        type: 'POST',
                        data: {_token: admin.common.get_csrf_token_value(), id: id},
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.status == 1) {
                                $('.alert').show();
                                $('#msg_main').html(data.msg);
                               // $('#msg_main').attr('style', 'color:green;');
                                admin.user.load_user();
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