admin.common = {
    initialize: function ()
    {
//        $('#language').on('change',function(){
//            var language_id = $(this).val();
//            $.ajax({
//                url: BASE_URL + '/' + ADMIN + '/language/change',
//                type: 'POST',
//                data: {_token: admin.common.get_csrf_token_value(), language_id: language_id},
//                success: function (data) {
//                    location.reload(true);
//                }
//            })
//        });
        $(".sidebar_platform").on('click', function () {
            $('.sidebar_platform').removeClass('kt-menu__item--active');
            var platform_id = $(this).data('id');
            admin.common.platfrom_change(platform_id);
        });
    },
    get_csrf_token_value: function () {
        return $("#csrf-token").val();
    },
    get_csrf_toke_object_data: function () {
        var data = {};
        data._token = this.get_csrf_token_value();
        return data;
    },
    get_csrf_toke_array_data: function () {
        var data = [];
        data['_token'] = this.get_csrf_token_value();
        return data;
    },
    get_success_msg: function (msg) {
        var data = [];
        data = $('#msg_main').text(msg);
        data = $('#msg_main').attr('style', 'color:green;');
        ;
        data = setTimeout(function () {
            $('#msg_main').hide();
        }, 3000);
        return data;
    },
    platfrom_change: function (platform_id) {


        $.ajax({
            type: 'POST',
            url: BASE_URL + '/platfrom_change',
            data: {_token: admin.common.get_csrf_token_value(), platform_id: platform_id},
            success: function (result) {
                $('.sidebar_platform[data-id=' + platform_id + ']').addClass('kt-menu__item--active');
                window.location.reload();
            },
        });

    },
};