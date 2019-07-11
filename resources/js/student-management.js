$(document).ready(function() {
    $('#student-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#studentTableAjaxRoute').val(),
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'full_name' },
            { data: 'id_card' },
            { data: 'phone' },
            { data: 'local_address' },
            { data: 'current_address' },
            { data: 'generation_name' },
            { data: 'department_name' },
            { data: 'avatar' },
            { data: 'manager' },
        ]
    });
});

$('#confirmDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('whatever') // Extract info from data-* attributes
  $('#confirmDeleteStudentForm').attr('action', route('student-management.destroy', id));

})
