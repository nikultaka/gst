admin.table = {
    initialize: function ()
    {
        var this_class = this;

        admin.table.load_sales_table();
        admin.table.load_sales_return_table();
        admin.table.load_reporting_table();
        admin.table.load_reporting_sales_table();
    },
    load_sales_table: function () {

        var table = jQuery('.sales-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [],
            ajax: {
                url: BASE_URL + '/sales_table',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'date', name: 'date'},
                {data: 'invoice_num', name: 'invoice_num'},
                {data: 'state_code_name', name: 'state_code_name'},
                {data: 'taxable_amount', name: 'taxable_amount'},
                {data: 'gst_rate', name: 'gst_rate'},
                {data: 'hsn_sac', name: 'hsn_sac'},
                {data: 'igst', name: 'igst'},
                {data: 'sgst', name: 'sgst'},
                {data: 'cgst', name: 'cgst'},
                {data: 'gross_total', name: 'gross_total'},
                {data: 'round_off', name: 'round_off'},
                {data: 'invoice_amount', name: 'invoice_amount'},
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                total = api.column(3).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(3).footer()).html(total + ' Total taxable amount');

                total = api.column(6).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(6, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(6).footer()).html(total + ' Total IGST');

                total = api.column(7).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(7, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(7).footer()).html(total + ' Total SGST');

                total = api.column(8).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(8, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(8).footer()).html(total + ' Total CGST');

                total = api.column(9).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(9, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(9).footer()).html(total + ' Total Gross');

                total = api.column(10).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(10, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(10).footer()).html(total + ' Total Round off');

                total = api.column(11).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(11, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(11).footer()).html(total + ' Total Invoice Amount');

            }
        });

    },
    load_sales_return_table: function () {

        var table = jQuery('.sales-return-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [],
            ajax: {
                url: BASE_URL + '/sales_return_table',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'date', name: 'date'},
                {data: 'invoice_num', name: 'invoice_num'},
                {data: 'state_code_name', name: 'state_code_name'},
                {data: 'taxable_amount', name: 'taxable_amount'},
                {data: 'gst_rate', name: 'gst_rate'},
                {data: 'hsn_sac', name: 'hsn_sac'},
                {data: 'igst', name: 'igst'},
                {data: 'sgst', name: 'sgst'},
                {data: 'cgst', name: 'cgst'},
                {data: 'gross_total', name: 'gross_total'},
                {data: 'round_off', name: 'round_off'},
                {data: 'invoice_amount', name: 'invoice_amount'},
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                total = api.column(3).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(3).footer()).html(total + ' Total taxable amount');

                total = api.column(6).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(6, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(6).footer()).html(total + ' Total IGST');

                total = api.column(7).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(7, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(7).footer()).html(total + ' Total SGST');

                total = api.column(8).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(8, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(8).footer()).html(total + ' Total CGST');

                total = api.column(9).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(9, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(9).footer()).html(total + ' Total Gross');

                total = api.column(10).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(10, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(10).footer()).html(total + ' Total Round off');

                total = api.column(11).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(11, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(11).footer()).html(total + ' Total Invoice Amount');

            }
        });

    },
    load_reporting_table: function () {

        var table = jQuery('.reporting-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [],
            ajax: {
                url: BASE_URL + '/reporting_sales',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'place_of_supply', name: 'place_of_supply'},
                {data: 'gst_rate', name: 'gst_rate'},
                {data: 'total_taxable_amount', name: 'total_taxable_amount'},
                {data: 'total_igst', name: 'total_igst'},
                {data: 'total_cgst', name: 'total_cgst'},
                {data: 'total_sgst', name: 'total_sgst'},
                {data: 'total', name: 'total',orderable : false},

            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                total = api.column(2).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(2, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(2).footer()).html(total + ' Total taxable amount');
                
                total = api.column(3).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(3).footer()).html(total + ' Total IGST');

                total = api.column(4).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(4).footer()).html(total + ' Total CGST');

                total = api.column(5).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(5, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(5).footer()).html(total + ' Total SGST');

                total = api.column(6).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(6, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(6).footer()).html(total + ' Total');


            }
        });

    },
    
    load_reporting_sales_table: function () {

        var table = jQuery('.reporting-sales-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [],
            ajax: {
                url: BASE_URL + '/reporting_sales_return',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'place_of_supply', name: 'place_of_supply'},
                {data: 'gst_rate', name: 'gst_rate'},
                {data: 'total_taxable_amount', name: 'total_taxable_amount'},
                {data: 'total_igst', name: 'total_igst'},
                {data: 'total_cgst', name: 'total_cgst'},
                {data: 'total_sgst', name: 'total_sgst'},
                {data: 'total', name: 'total' ,orderable : false},

            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                total = api.column(2).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(2, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(2).footer()).html(total + ' Total taxable amount');
                
                total = api.column(3).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(3, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(3).footer()).html(total + ' Total IGST');

                total = api.column(4).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(4).footer()).html(total + ' Total CGST');

                total = api.column(5).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(5, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(5).footer()).html(total + ' Total SGST');

                total = api.column(6).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                pageTotal = api.column(6, {page: 'current'}).data().reduce(function (a, b) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                }, 0);
                $(api.column(6).footer()).html(total + ' Total');

            }
        });

    },
};