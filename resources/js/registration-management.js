$(document).ready(function() {
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

$(document).ready(function() {
    $('#inputSubjectSelect').change(function(){
        var value = $("#inputSubjectSelect option:selected").val();
        if (value != 0) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: route('admins.registration-management.index.ajax'),
                type: 'POST',
                data: { 'value':value },
                dataType: 'json',
                success: function (data) {
                    if (data != null) {
                        var str = '';
                        $.each(data, function(key, value){
                            str += "<tr>";
                            str += "<td>" + value.stt + "</td>";
                            str += "<td>" + value.subject  + "</td>";
                            str += "<td>" + value.teacher + "</td>";
                            str += "<td>" + value.group + "</td>";
                            str += "<td>" + value.room + "</td>";
                            str += "<td>" + value.size + "</td>";
                            str += "<td>" + value.lesson + "</td>";
                            str += "<td>" + value.day + "</td>";
                            str += "</tr>";
                        });
                        $("#registrationClassTable").html(str);
                    } else {
                        alert("error");
                    }
                    
                },
                error: function (e) {
                    alert("error");
                }
            });
        }
    });
});

$('#createSemesterModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
})

$('#createSemesterForm').submit(function(e){
    e.preventDefault();  
    var form = $(this);

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: route('admins.registration-management.create.form-ajax'),
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function (data) {
            var str = '<div class="alert alert-success text-center">';
            str += data.success;
            str += '</div>';
            $('#alert-area').html(str);

            var option = '<option value="' + data.id + '" selected>' + data.name + '</option>';
            $('#semesterSelect').append(option);
            
        },
        error: function (e) {
            if (e.responseJSON.errors) {
                var data = e.responseJSON.errors;
                var str = '<div class="alert alert-danger text-center">';
                jQuery.each(data, function(key, value){
                    str += value;
                    str += '<br>'; 
                });
                str += '</div>';
                $('#alert-area').html(str);
            } else {
                alert("error");
            }
        }
    });
});
