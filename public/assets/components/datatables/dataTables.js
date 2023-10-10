jQuery(function ($) {

    $.extend(true, $.fn.dataTable.defaults, {
        dom: "<'row'<'col-12 col-sm-6 tools-filter'f><'col-12 col-sm-6 text-right table-tools-col'>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'col-12 col-md-5'i><'col-12 col-md-7'p>>",
        renderer: 'bootstrap',
        classes: {
            sLength: "dataTables_length text-left w-auto",
        },
        bDestroy: true,
        language: {
            search: '<i class="fa fa-search pos-abs mt-2 pt-3px ml-25 text-blue-m2"></i>',
            searchPlaceholder: " ค้นหา...",
            emptyTable:     "ไม่มีข้อมูล",
            info: "แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ ",
            infoEmpty:      "ไม่มีข้อมูล",
            infoFiltered: "กรองทั้งหมด _MAX_ ",
            zeroRecords: "ไม่พบข้อมูล",
            lengthMenu: "แสดง _MENU_ ",
            loadingRecords : "กำลังโหลดข้อมูล...",
            processing: "กำลังประมวลผล...",
            buttons: {
                copyTitle: 'คัดลอก',
                copySuccess: {
                    _: '%d รายการ'
                }
            },
            paginate: {
                first:      "»",
                last:       "«",
                next:       "›",
                previous:   "‹"
            },
            select: {
                rows: {
                    _: "<span class='text-danger'>เลือก %d รายการ</span>",
                    0: ""
                }
            }
        }
    });

    var tableId = '.datatable';
    var $_table = $(tableId).DataTable({
        // responsive: true,
        scrollX: true,
        lengthMenu : [ 50, 100],
        order: [[0, 'asc']],
        bDestroy: true,
        buttons: {
            dom: {
                button: {
                    className: 'btn' //remove the default 'btn-secondary'
                },
                container: {
                    className: 'dt-buttons btn-group bgc-white-tp2 text-right w-auto'
                }
            },
            buttons: [{
                "extend": "colvis",
                "text": "<i class='far fa-eye text-125 text-dark-m2'></i> <span class='d-none'>ข้อมูลที่แสดง</span>",
                "className": "btn-light-default btn-bgc-white btn-h-outline-primary btn-a-outline-primary",
                columns: ':not(:first)',
                exportOptions: { columns: ':not(.d-print-none)',}
            },
            {
                "extend": "copy",
                "text": "<i class='far fa-copy text-125 text-purple'></i> <span class='d-none'>คัดลอก</span>",
                "className": "btn-light-default btn-bgc-white btn-h-outline-primary btn-a-outline-primary",
                exportOptions: { columns: ':not(.d-print-none)',}
            },
            {
                "extend": "excelHtml5",
                "text": "<i class='fa fa-database text-125 text-success-m1'></i> <span class='d-none'>Excel</span>",
                "className": "btn-light-default btn-bgc-white btn-h-outline-primary btn-a-outline-primary",
                exportOptions: { columns: ':not(.d-print-none)',}
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print text-125 text-orange-d1'></i> <span class='d-none'>Print</span>",
                "className": "btn-light-default btn-bgc-white  btn-h-outline-primary btn-a-outline-primary",
                // autoPrint: true,
                message: $('#table-message').text().trim(),
                exportOptions: { columns: ':not(.d-print-none)',}
            }
            ]
        },

        // first and last column are not sortable
        columnDefs: [
        {
            orderable: false,
            className: null,
            targets: -1
        },
        ],

    });
    var tableIdOnly = '.datatable-only';
    var $_tableOnly = $(tableIdOnly).DataTable({
        // responsive: true,
        scrollX: true,
        lengthMenu : [ 20, 100],
        order: [[0, 'asc']],
        buttons: {
            dom: {
                button: {
                    className: 'btn' //remove the default 'btn-secondary'
                },
                container: {
                    className: 'dt-buttons btn-group bgc-white-tp2 text-right w-auto'
                }
            },
        },

        // first and last column are not sortable
        columnDefs: [
        {
            orderable: false,
            className: null,
            targets: -1
        },
        ],

    });
    $('div.dataTables_filter input').addClass('pl-45 radius-round');
    $('.tools-filter')
        .append($_table.buttons().container())
        .find('.dataTables_filter').appendTo('.page-tools').find('input').addClass('pl-45 radius-round').removeClass('form-control-sm');

    var tableId_checkbox = '.datatable-checkbox';
    var $_table_checkbox = $(tableId_checkbox).DataTable({
        responsive: true,
        lengthMenu : [25, 50, 100],
        order: [[1, 'asc']],
        buttons: {
            dom: {
                button: {
                    className: 'btn' //remove the default 'btn-secondary'
                },
                container: {
                    className: 'dt-buttons btn-group bgc-white-tp2 text-right w-auto'
                }
            },

            buttons: [{
                "extend": "colvis",
                "text": "<i class='far fa-eye text-125 text-dark-m2'></i> <span class='d-none'>ข้อมูลที่แสดง</span>",
                "className": "btn-light-default btn-bgc-white btn-h-outline-primary btn-a-outline-primary",
                columns: ':not(:first)',
                exportOptions: { columns: ':not(.d-print-none)',}
            },
            {
                "extend": "copy",
                "text": "<i class='far fa-copy text-125 text-purple'></i> <span class='d-none'>คัดลอก</span>",
                "className": "btn-light-default btn-bgc-white btn-h-outline-primary btn-a-outline-primary",
                exportOptions: { columns: ':not(.d-print-none)',}
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-database text-125 text-success-m1'></i> <span class='d-none'>ส่งออก CSV</span>",
                "className": "btn-light-default btn-bgc-white btn-h-outline-primary btn-a-outline-primary",
                exportOptions: { columns: ':not(.d-print-none)',}
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print text-125 text-orange-d1'></i> <span class='d-none'>Print</span>",
                "className": "btn-light-default btn-bgc-white  btn-h-outline-primary btn-a-outline-primary",
                // autoPrint: false,
                message: $('#table-message').text().trim(),
                exportOptions: { columns: ':not(.d-print-none)',}
            }
            ]
        },

        // first and last column are not sortable
        columnDefs: [{
            orderable: false,
            className: null,
            targets: 0
        },
        {
            orderable: false,
            className: null,
            targets: -1
        },
        ],

        // multiple row selection
        select: {
            style: 'multis'
        },

    });


    $('.tools-filter')
        .append($_table_checkbox.buttons().container())
        .find('.dataTables_filter').appendTo('.page-tools').find('input').addClass('pl-45 radius-round').removeClass('form-control-sm');


    // helper methods to add/remove bgc-h-* class when selecting/deselecting rows
    var _highlightSelectedRow = function (row) {
        row.querySelector('input[type=checkbox]').checked = true
        row.classList.add('bgc-success-l3')
        row.classList.remove('bgc-h-default-l4')
    }
    var _unhighlightDeselectedRow = function (row) {
        row.querySelector('input[type=checkbox]').checked = false
        row.classList.remove('bgc-success-l3')
        row.classList.add('bgc-h-default-l4')
    }

    // listen to select/deselect event to highlight rows
    $_table_checkbox
        .on('select', function (e, dt, type, index) {
            if (type == 'row') {
                var row = $_table_checkbox.row(index).node()
                _highlightSelectedRow(row)
            }
        })
        .on('deselect', function (e, dt, type, index) {
            if (type == 'row') {
                var row = $_table_checkbox.row(index).node()
                _unhighlightDeselectedRow(row)
            }
        })

    // when clicking the checkbox in table header, select/deselect all rows
    $(tableId_checkbox)
        .on('click', 'th input[type=checkbox]', function () {
            if (this.checked) {
                $_table_checkbox.rows().select().every(function () {
                    _highlightSelectedRow(this.node())
                });
            } else {
                $_table_checkbox.rows().deselect().every(function () {
                    _unhighlightDeselectedRow(this.node())
                })
            }
        })



    // add/remove bgc-h-* class to TH when soring columns
    var previousTh = null
    var toggleTH_highlight = function (th) {
        th.classList.toggle('bgc-yellow-l2')
        th.classList.toggle('bgc-h-yellow-l3')
        th.classList.toggle('text-blue-d2')
    }

    $(tableId_checkbox)
        .on('click', 'th:not(.sorting_disabled)', function () {
            if (previousTh != null) toggleTH_highlight(previousTh) // unhighlight previous TH
            toggleTH_highlight(this)
            previousTh = this
        })


    //enable tooltips
    setTimeout(function () {
        $('.dt-buttons button')
            .each(function () {
                var div = $(this).find('span').first()
                if (div.length == 1) $(this).tooltip({
                    container: 'body',
                    title: div.parent().text()
                })
                else $(this).tooltip({
                    container: 'body',
                    title: $(this).text()
                })
            })
        $('[data-rel=tooltip').tooltip({
            container: 'body'
        })
    }, 0);

});
