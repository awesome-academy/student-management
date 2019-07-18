$(document).ready(function() {
    console.log($('#registrationTableAjaxRoute').val());
    $('#registration-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#registrationTableAjaxRoute').val(),
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'datetime_begin' },
            { data: 'datetime_finish' },
            { data: 'min_credits' },
            { data: 'max_credits' },
            { data: 'admin_name' },
            { data: 'time_status' },
            { data: 'status' },
            { data: 'manager' },
        ]
    });
});
