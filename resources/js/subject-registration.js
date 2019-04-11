$(document).ready(function() {
    $("#subjectSelect").change(function() {
        var value = $("#subjectSelect option:selected").val();
        if (value) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: route('students.class_table_ajax'),
                type: 'POST',
                data: { 'value':value },
                dataType: 'json',
                success: function (data) {
                    if (data != null) {
                        var str = '';
                        $.each(data, function(key, value){
                            str += "<tr>";
                            str += "<td><input type='radio' name='radio' value='" + value.id_class + "'></td>";
                            str += "<td>" + value.subject  + "</td>";
                            str += "<td>" + value.group + "</td>";
                            str += "<td>" + value.teacher + "</td>";
                            str += "<td>" + value.room + "</td>";
                            str += "<td>" +value.registered + "/" + value.size + "</td>";
                            str += "<td>" + value.lesson + "</td>";
                            str += "<td>" + value.day + "</td>";
                            str += "</tr>";
                        });
                        $("#tableBody").html(str);
                    } else {
                        alert("error");
                    }
                    
                },
                error: function (e) {
                    alert("error");
                }
            });
        } else {
            alert("Please choose a subject!!");
        }
        
    });
});
