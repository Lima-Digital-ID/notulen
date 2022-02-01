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

    var t = $("#ref_gaji_list").dataTable({
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
        ajax: {"url": "ref_gaji/json", "type": "POST"},
        columns: [
            {
                "data": "id_ref_gaji",
                "orderable": false
            },{"data": "nama_jabatan"},
            {"data": "gaji_pokok", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.gaji_pokok)}},
            {"data": "uang_kehadiran", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_kehadiran)}},
            {"data": "uang_makan", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_makan)}},
            {"data": "uang_transport", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_transport)}},
            {"data": "uang_lembur", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_lembur)}},
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

function cekGaji(val){
    $('#gaji_pokok').val(formatRupiah(val.value));
}
function cekUM(val){
    $('#uang_makan').val(formatRupiah(val.value));
}
function cekUK(val){
    $('#uang_kehadiran').val(formatRupiah(val.value));
}
function cekUT(val){
    $('#uang_transport').val(formatRupiah(val.value));
}
function cekUL(val){
    $('#uang_lembur').val(formatRupiah(val.value));
}
function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa  = split[0].length % 3,
      rupiah  = split[0].substr(0, sisa),
      ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
      
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}