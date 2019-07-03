$(document).ready(function() {
    $('#generation-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#generationTableAjaxRoute').val(),
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'begin_year' },
            { data: 'manager' },
        ]
    });
});

$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever');
    var generation;
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: route('admins.generation-modal-ajax'),
        type: 'GET',
        data: { 'id' : id },
        dataType: 'json',
        success: function (data) {
            if (data != null) {
                $('#updateForm').attr("action", route('admins.update-generation', id));
                $('#name').val(data.name);
                $('#begin_year').val(data.begin_year);
               
            } else {
                alert("error");
            }
            
        },
        error: function (e) {
            alert("error");
        }

    });
    
});

function deleteGeneration(id){
    window.location = route('admins.delete-generation', id);
}

$('#addModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);    
});
