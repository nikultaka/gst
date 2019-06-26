admin.dashboard = {
    initialize: function ()
    {
        var this_class = this;

        admin.dashboard.client_name_search();
        admin.dashboard.financial_year();
        admin.dashboard.month_quarter();

        admin.dashboard.refresh_validator();
        admin.dashboard.check_uploaded_file();

//        admin.dashboard.platfrom_change('');
        $("#upload").attr("disabled", true);


//        For maintain selected client
        var selected_client_id = sessionStorage.getItem("client_id");
        var selected_client_name = sessionStorage.getItem("client_text");
        var client_option = $("<option selected='selected'></option>").val(selected_client_id).text(selected_client_name)
        $("#client_name").append(client_option).trigger('change');

//        For maintain selected Financial year
        var selected_financial_year_id = sessionStorage.getItem("financial_year_id");
        var selected_financial_year_text = sessionStorage.getItem("financial_year_text");
        var financial_year_option = $("<option selected='selected'></option>").val(selected_financial_year_id).text(selected_financial_year_text)
        $("#financial_year").append(financial_year_option).trigger('change');

//        For maintain selected Month/Quarter
        var selected_month_quarter_id = sessionStorage.getItem("month_quarter_id");
        var selected_month_quarter_text = sessionStorage.getItem("month_quarter_text");
        var month_quarter_option = $("<option selected='selected'></option>").val(selected_month_quarter_id).text(selected_month_quarter_text)
        $("#month_quarter").append(month_quarter_option).trigger('change');

//        For maintain selected type
        var select_type_id = sessionStorage.getItem("select_type_id");
        var select_type_text = sessionStorage.getItem("select_type_text");
        
        if(select_type_id == "" || select_type_id == null){
            $("#select_type").val(0);
        } else {
            $("#select_type").val(select_type_id);
        }


        $('#select_type').select2({
            placeholder: 'Select type',
        });
        
//        $(".sidebar_platform").on('click', function () {
//            $('.sidebar_platform').removeClass('kt-menu__item--active');
//            var platform_id = $(this).data('id');
//            admin.dashboard.platfrom_change(platform_id);
//        });

        $("#client_name").on('change', function () {
//            var client_id = $(this).val();
            admin.dashboard.financial_year();
        });

        $("#client_name").on('select2:select', function (e) {
            admin.dashboard.save_session();
            sessionStorage.setItem("client_id", $(this).val());
            sessionStorage.setItem("client_text", $(this).find('option:selected').text());
            $("#financial_year").append($("<option selected='selected'></option>").val('').text('')).trigger('change');
            $("#month_quarter").append($("<option selected='selected'></option>").val('').text('')).trigger('change');
            admin.table.load_reporting_table();
            admin.table.load_reporting_sales_table();
        });

        $("#financial_year").on('select2:select', function (e) {
            sessionStorage.setItem("financial_year_id", $(this).val());
            sessionStorage.setItem("financial_year_text", $(this).find('option:selected').text());
            $("#month_quarter").append($("<option selected='selected'></option>").val('').text('')).trigger('change');

            sessionStorage.setItem("month_quarter_id", '');
            sessionStorage.setItem("month_quarter_text", '');

            admin.dashboard.save_session();
            $(".content_div").hide();
            $("#content_div").html('');
            $("#success_msg").html('');
            $('.error_div').hide();
            $("#msg").html('');
            $("#success_msg").html('');
            admin.table.load_reporting_table();
            admin.table.load_reporting_sales_table();
        });

        $("#month_quarter").on('select2:select', function (e) {
            admin.dashboard.save_session();
            sessionStorage.setItem("month_quarter_id", $(this).val());
            sessionStorage.setItem("month_quarter_text", $(this).find('option:selected').text());
            admin.table.load_reporting_table();
            admin.table.load_reporting_sales_table();
        });

        $("#select_type").on('select2:select', function (e) {
            admin.dashboard.save_session();
            sessionStorage.setItem("select_type_id", $(this).val());
            sessionStorage.setItem("select_type_text", $(this).find('option:selected').text());
            admin.table.load_reporting_table();
            admin.table.load_reporting_sales_table();
        });

        $(".select_dropdown").on('select2:select', function (e) {
//            admin.dashboard.save_session();
        });

        $("#financial_year").on('change', function () {
//            var financial_year_id = $(this).val();
            admin.dashboard.month_quarter();
        });

    },
    check_uploaded_file: function () {
        $('#upload_file').change(function () {

            var file = $('#upload_file').val();
            var exts = ['csv'];
            // first check if file field has any value
            if (file) {
                // split file name at dot
                var get_ext = file.split('.');
                // reverse name to check extension
                get_ext = get_ext.reverse();
                // check file type is valid as given in 'exts' array
                if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
//                    alert('Allowed extension!');
                    $("#error_msg").css('color', 'red');
                    $("#error_msg").html('');
                    $("#upload").attr("disabled", false);
                } else {
                    $("#upload").attr("disabled", true);
                    $("#error_msg").css('color', 'red');
                    $("#error_msg").html('Only csv files can be uploaded.');
                }
            }

        });
    },
    save_session: function () {

        var client_id = $("#client_name").val();
        var financial_year_id = $("#financial_year").val();
        var month_quarter_id = $("#month_quarter").val();
        var select_type = $("#select_type").val();

        $.ajax({
            url: BASE_URL + '/savesession',
            type: 'POST',
            data: {_token: admin.common.get_csrf_token_value(), client_id: client_id,
                financial_year_id: financial_year_id, month_quarter_id: month_quarter_id, select_type: select_type},
            success: function (data) {

            }
        });

    },
    client_name_search: function () {
        $('#client_name').select2({
            placeholder: 'Client Name',
            ajax: {
                url: BASE_URL + '/client_search',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term, // search term
                        _token: admin.common.get_csrf_token_value()
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    },
    financial_year: function () {

        $('#financial_year').select2({
            placeholder: 'Financial Year',
            ajax: {
                url: BASE_URL + '/financial_year',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {

                    var client_id = $("#client_name").val();
                    return {
                        _token: admin.common.get_csrf_token_value(),
                        searchTerm: params.term,
                        client_id: client_id,
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    },
    month_quarter: function () {

        $('#month_quarter').select2({
            placeholder: 'Month/Quarter',
            ajax: {
                url: BASE_URL + '/month_quarter',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {

                    var client_id = $("#client_name").val();
                    var financial_year_id = $("#financial_year").val();

                    return {
                        searchTerm: params.term,
                        client_id: client_id,
                        financial_year_id: financial_year_id,
                        _token: admin.common.get_csrf_token_value(),
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

    },
    refresh_validator: function () {



        $.validate({
            modules: 'file',
            form: '#upload_form',
            onSuccess: function () {
                $('.loader').show();
                $("#msg").html('');
                var client_id = $("#client_name").val();
                var financial_year_id = $("#financial_year").val();
                var month_quarter_id = $("#month_quarter").val();
                var select_type = $("#select_type").val();
                var form = $("#upload_form");

                var formData = new FormData(form[0]);
                formData.append('client_id', client_id);
                formData.append('financial_year_id', financial_year_id);
                formData.append('month_quarter_id', month_quarter_id);
                formData.append('select_type', select_type);

                $.ajax({
                    type: 'POST',
                    url: BASE_URL + '/upload_file',
                    data: formData,
                    datatype: 'json',
                    success: function (result) {
                        var data = $.parseJSON(result);

                        $(".content_div").hide();
                        $("#content_div").html('');
                        $("#msg").html('');
                        if (data.status == 0) {
                            $("#success_msg").html('');
                            $('.error_div').show();
                            $("#msg").css('color', 'red');
                            $("#msg").html(data.msg);
                        } else {
                            $('.error_div').hide();
                            $("#msg").html('');
                            $("#success_msg").css('color', 'green');
                            $("#success_msg").html(data.msg);
                        }
                        if (data.content != '') {
                            $(".content_div").show();
                            $("#content_div").html(data.content);
                        }
                        $('.loader').hide();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            },
        });
    },
};