$(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var t = $("#shift_list").dataTable({
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                }
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "shift/json", "type": "POST"},
        columns: [
            {
                "data": "id_shift",
                "orderable": false
            },{"data": "nama_shift"},{"data": "jam_datang", "render": function(data, type, row){ return formatTime(row.jam_datang)}},{"data": "jam_pulang", "render": function(data, type, row){ return formatTime(row.jam_pulang)}},
            {
                "data" : "action",
                "orderable": false,
                "className" : "text-center"
            }
        ],
        order: [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });
});
function formatTime(time) {
    if (time != '') {
        var tempTime=time.split(':');
        return tempTime[0] + ':' + tempTime[1];
    }else{
        return '-';
    }
}