$(document).ready(function() {
    var week_id = $('#weekSelect').val();
    if (week_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('students.schedule_table_ajax'),
            type: 'POST',
            data: { 'week_id' : week_id },
            dataType: 'json',
            success: function (data) {
                if (data != null) {
                    $.each(data, function(key, value){
                        if (value.lessons >= week_id) {
                            var id_item = value.day_id + '' + value.lesson_id;
                            var str = '';
                            str += 'MH: ' + value.subject;
                            str += '<br>'
                            str += 'PH: ' + value.room;
                            $('#' + id_item).html(str).addClass('item-hadData-display')
                            .attr('value', value.id_class)
                            .attr('data-toggle', 'popover')
                            .attr('data-trigger', 'hover');

                            var str = '';
                            str += "<p>Môn học: " + value.subject + "</p>";
                            str += "<p>Giảng viên: " + value.teacher + "</p>";
                            str += "<p>Nhóm lớp: " + value.class_group + "</p>";
                            str += "<p>Phòng học: " + value.room + "</p>";
                            str += "<p>Số TC: " + value.credit + "</p>";

                            $("[data-toggle = 'popover']").popover({
                                title : value.subject,
                                content : str,
                                html : true,

                            });
                        }  
                    });
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
