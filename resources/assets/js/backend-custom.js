/**
 * Created by usamaahmed on 5/18/17.
 */

$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[0, "desc"]],
        "bPaginate": true,
        "scrollY":        "1500px",
        "scrollCollapse": true,
        "paging":         true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "pageLength": 50,
        language: {
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            emptyTable: "No data available in table",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries found",
            infoFiltered: "(filtered1 from _MAX_ total entries)",
            lengthMenu: "_MENU_ entries",
            search: "Search / بحث",
            zeroRecords: "No matching records found"
        },
        buttons: [{extend: "print", className: "btn dark btn-outline"}, {
            extend: "copy",
            className: "btn red btn-outline",
        },
            {extend: "pdf", className: "btn green btn-outline"},
            {extend: "excel", className: "btn yellow btn-outline hidden "},
            {extend: "csv", className: "btn purple btn-outline hidden"}, {
            extend: "colvis",
            className: "btn dark btn-outline",
            text: "Columns / عرض المزيد"
        }],
        responsive: !0,
        lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });
    $('#dataTableLong').DataTable({
        "order": [[0, "desc"]],
        "bPaginate": true,
        "scrollY":        "1500px",
        "scrollCollapse": true,
        "paging":         true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "pageLength": 100,
        language: {
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            emptyTable: "No data available in table",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries found",
            infoFiltered: "(filtered1 from _MAX_ total entries)",
            lengthMenu: "_MENU_ entries",
            search: "Search / بحث",
            zeroRecords: "No matching records found"
        },
        buttons: [{extend: "print", className: "btn dark btn-outline"}, {
            extend: "copy",
            className: "btn red btn-outline",
        },
            {extend: "pdf", className: "btn green btn-outline"},
            {extend: "excel", className: "btn yellow btn-outline hidden "},
            {extend: "csv", className: "btn purple btn-outline hidden"}, {
                extend: "colvis",
                className: "btn dark btn-outline",
                text: "Columns / عرض المزيد"
            }],
        responsive: !0,
        lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });
    $('table[id^="differentDataTable-"]').DataTable({
        "order": [[0, "desc"]],
        "bPaginate": true,
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "pageLength": 10
    });
    $('table[id^="moreDataTable-"]').DataTable({
        "order": [[0, "desc"]],
        "scrollY":        "350px",
        "scrollCollapse": true,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "pageLength": 5
    });
    $('#basic').on('show.bs.modal', function(event) {
        var element = $(event.relatedTarget) // Button that triggered the modal
        $('.modal-body').html(element.data('content'));
        $('.modal-title').html(element.data('title'));
        formId = element.data('form_id');
        console.log('fromId', formId);
        $('.modal-save').on('click', function () {
            $('#' + formId).submit();
        });
    });
    $("#my_multi_select3").multiSelect();
    $("#my_multi_select4").multiSelect();
    $("#my_multi_select5").multiSelect();
    $("#my_multi_select6").multiSelect();
    $("#my_multi_select7").multiSelect();
});

tinymce.init({
    selector: '.tinymce',
    height: 300,
    plugins: 'emoticons code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
    toolbar1: 'emoticons code formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ],
    style_formats: [
        { title: 'Headers', items: [
                { title: 'h1', block: 'h1' },
                { title: 'h2', block: 'h2' },
                { title: 'h3', block: 'h3' },
                { title: 'h4', block: 'h4' },
                { title: 'h5', block: 'h5' },
                { title: 'h6', block: 'h6' }
            ] },

        { title: 'Blocks', items: [
                { title: 'p', block: 'p' },
                { title: 'div', block: 'div' },
                { title: 'pre', block: 'pre' }
            ] },

        { title: 'Containers', items: [
                { title: 'section', block: 'section', wrapper: true, merge_siblings: false },
                { title: 'article', block: 'article', wrapper: true, merge_siblings: false },
                { title: 'blockquote', block: 'blockquote', wrapper: true },
                { title: 'hgroup', block: 'hgroup', wrapper: true },
                { title: 'aside', block: 'aside', wrapper: true },
                { title: 'figure', block: 'figure', wrapper: true }
            ] }
    ],
    visualblocks_default_state: true,
    end_container_on_empty_block: true
});


tinymce.init({
    selector: '.tinymce-notifications',
    height: 200,
    plugins: 'emoticons',
    toolbar1: 'emoticons',
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ],
    visualblocks_default_state: true,
    end_container_on_empty_block: true
});



