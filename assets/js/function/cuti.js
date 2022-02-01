$(document).ready(function() {
    var date="";
    if (typeof bulan != 'undefined') {
        $('#bulan').val(bulan).change();
        $('#tahun').val(tahun).change();
        $('#bulan_form').val(bulan).change();
        $('#tahun_form').val(tahun).change();
        date=tahun+'-'+bulan;
    }
    $('#title').html(formatDate(date));
    t = $('#cuti_list').DataTable();
    t.clear().draw(false);
    $.ajax({
        type: "POST",
        url: "cuti/json", //json get site
        data : {bulan: date},
        dataType : 'json',
        success: function(response){
            arrData = response['data'];
            // console.log(arrData);
            var j=0;
            for(i = 0; i < arrData.length; i++){
                j+=1;
                t.row.add([
                    '<div class="text-center">'+j+'</div>',
                    '<div class="text-left">'+arrData[i]['nama_pegawai']+'</div>',
                    '<div class="text-left">'+arrData[i]['tanggal_cuti']+'</div>',
                    '<div class="text-left">'+
                    '<a href="'+uri+'hrms/cuti/create/'+arrData[i]['id_pegawai']+'/'+date+'" class="btn waves-effect waves-light btn-xs btn-success" title="edit"><i class="fa fa-edit"></i></a> '+
                    '</div>'
                ]).draw(false);
            }
        }
    });


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

    var w = $("#holiday_list").dataTable({
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
        ajax: {"url": "json_holiday/"+year, "type": "POST"},
        columns: [
            {
                "data": "id",
                "orderable": false
            },{"data": "tanggal", "render": function(data, type, row){ return dateFormat(row.tanggal) }},
            {"data": "ket"},
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
function formatDate(date){
    var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var newDate=date.split('-');
    return bulan[newDate[1]-1]+' '+newDate[0];
}
function dateFormat(date) {
  var temp=date.split('-');
  return temp[2] + '-' + temp[1] + '-' + temp[0];
}
function cekDetail(obj){
    (function($) {
        var id=$(obj).data('id');
        console.log(id);
        'use strict';

        var t=$('#detail_cuti_bersama').DataTable();
        t.clear().draw(false);
        $.ajax({
            type: "GET",
            url: "json_cuti_bersama_detail/"+id, //json get site
            dataType : 'json',
            success: function(response){
                var arrData = response['data'];
                // $('#namaMember').html('Member '+arrData[0]['us_nama']);
                for(var i = 0; i < arrData.length; i++){
                    var date=dateFormat(arrData[i]['tanggal']);
                    t.row.add([
                        '<div class="text-left">'+date+'</div>',
                    ]).draw(false);
                }
            }
        });
    }).apply(this, [jQuery]);
}