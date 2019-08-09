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

        $('input:radio').on('change', function () {
            var name = $(this).attr("name");
            $('input[name="'+name+'"]').removeAttr('checked');
            $(this).attr("checked", "checked");
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
//                {data: 'name', name: 'name'},
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
                        $('#msg_main').html('');
                        if (data.status == 1) {
                            $('#msg_main').css('color', 'green');
                            $('#msg_main').html(data.msg);
                            $('#frm_client')[0].reset()
                            admin.client.load_client();
                        } else {
                            $('#msg_main').css('color', 'red');
                            $('#msg_main').html(data.msg);
                        }
//                        $("#ins_client").modal("hide");
                    }
                });
            },
            onValidate: function ($form) {

                var result_array = [];
                var obj = {};
                var obj1 = {};
                var gstin = $('#gstin').val();
//                var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
//                var gstinformat = new RegExp('\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}');
//                var gstinformat = new RegExp('^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-7]{1})([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$');
//
////                if (gstinformat.test(inputvalues)) {
//                if (inputvalues.match(gstinformat)) {
////                    return true;
//                } else {
//                    obj.element = $('#gstin');
//                    obj.message = 'Please Enter Valid GSTIN Number';
//                    result_array.push(obj);
//                }

                if (!admin.client.validGSTIN(gstin)) {
                    obj.element = $('#gstin');
                    obj.message = 'Please Enter Valid GSTIN Number';
                    result_array.push(obj);
                }else{
//                    alert('Right');
                }
                
                //Make groups
                var names = [];
                $('input:radio').each(function () {
                    var rname = $(this).attr('name');
                    if ($.inArray(rname, names) == -1)
                        names.push(rname);
                });

                //do validation for each group
                var checked = [];
                $.each(names, function (i, name) {
                    if ($('input[name="' + name + '"]:checked').length > 0) {
                        checked.push(name);
                    }
                });

                if (checked.length == 0) {
                    obj1.element = $('#hidden-radio');
                    obj1.message = 'Please Selct atleast One year.';
                    result_array.push(obj1);
                }

                return result_array;
            }
        });
    },
//    edit_row: function (id) {
//
//        if (id > 0) {
//            $.ajax({
//                url: BASE_URL + '/clients/edit',
//                type: 'POST',
//                data: {_token: admin.common.get_csrf_token_value(), id: id},
//                success: function (data) {
//                    var data = $.parseJSON(data);
//                    if (data.status == 1) {
//
//                        $("#client_id").val(data.content.id);
//                        $("#user_id").val(data.content.user_id);
//                        $("#cl_name").val(data.content.client_name);
//                        $("#gstin").val(data.content.gstin);
//
//                        $("#ins_client").modal("show");
//                    }
//                }
//            });
//        }
//        else {
//            return false;
//        }
//    },
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
    }   },
    /** GSTIN validation functions start here */
    validGSTIN: function (gstin) {
        var GSTINFORMAT_REGEX = "[0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9A-Za-z]{1}[Z]{1}[0-9a-zA-Z]{1}";
        var isValidFormat = false;
        if (admin.client.checkPattern(gstin, GSTINFORMAT_REGEX)) {
            isValidFormat = admin.client.verifyCheckDigit(gstin);
        }
        return isValidFormat;
    },
    verifyCheckDigit: function (gstin) {
        var isCDValid = false;
        var newGstninWCheckDigit = admin.client.getGSTINWithCheckDigit(gstin.substr(0, gstin.length - 1));
        if (gstin.trim() == newGstninWCheckDigit) {
            isCDValid = true;
        }
        return isCDValid;
    },
    checkPattern: function (inputval, regxpatrn) {
        var result = false;
        var input = inputval.trim();
        if (input.match(regxpatrn)) {
            result = true;
        }
        return result;
    },
    getGSTINWithCheckDigit: function (gstinWOCheckDigit) {
        var factor = 2;
        var sum = 0;
        var checkCodePoint = 0;
        var cpChars = new Array();
        var inputChars = new Array();
        var GSTN_CODEPOINT_CHARS = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if (gstinWOCheckDigit == null) {
            console.log("GSTIN supplied for checkdigit calculation is null.");
        }
        cpChars = GSTN_CODEPOINT_CHARS.split('');
        inputChars = gstinWOCheckDigit.trim().toUpperCase().split('');
        var mod = cpChars.length;
        for (var i = inputChars.length - 1; i >= 0; i--) {
            var codePoint = -1;
            for (var j = 0; j < cpChars.length; j++) {
                if (cpChars[j] == inputChars[i]) {
                    codePoint = j;
                }
            }

            var digit = factor * codePoint;
            factor = (factor == 2) ? 1 : 2;
            var calc1 = parseInt(digit) / parseInt(mod);
            var calc2 = parseInt(digit) % parseInt(mod);
            digit = parseInt(calc1) + parseInt(calc2);
            sum += digit;
        }
        checkCodePoint = (mod - (sum % mod)) % mod;
        return gstinWOCheckDigit + cpChars[checkCodePoint];
    },
};