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

    var t = $("#set_gaji_list").dataTable({
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
        ajax: {"url": "set_gaji/json", "type": "POST"},
        columns: [
            {
                "data": "id_setting_gaji",
                "orderable": false
            },{"data": "nama_pegawai"},{"data": "nama_jabatan"},
            {"data": "gaji_pokok", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.gaji_pokok)}},
            {"data": "gaji_min", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.gaji_min)}},
            // {"data": "uang_makan", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_makan)}},
            // {"data": "uang_transport", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_transport)}},
            // {"data": "uang_lembur", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.uang_lembur)}},
            // {"data": "potongan_telat", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.potongan_telat)}},
            {"data": "denda", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.denda)}},
            {"data": "denda_weekday", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.denda_weekday)}},
            {"data": "denda_weekend", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.denda_weekend)}},
            {"data": "bonus_kerajinan", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.bonus_kerajinan)}},
            {"data": "kom_min", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.kom_min)}},
            {"data": "kom_trx", "render": function(data, type, row){ return 'Rp. '+ formatRupiah(row.kom_trx)}},
            {"data": "tipe_gaji"},
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
  function CheckUk(val) {
    if ($(val).is(':checked')) {
      $('#div_uk').show();
    }else{
      $('#div_uk').hide();
    }
  }
  function CheckUt(val) {
    if ($(val).is(':checked')) {
      $('#div_ut').show();
    }else{
      $('#div_ut').hide();
    }
  }
  function CheckUm(val) {
    if ($(val).is(':checked')) {
      $('#div_um').show();
    }else{
      $('#div_um').hide();
    }
  }
  // function cekPegawai(){
  //   var pegawai=$('#id_pegawai').val();
  //   console.log(pegawai);
  //   if (pegawai == 0) {
  //     $('#gaji_pokok').val('');
  //     $('#uang_kehadiran').val('');
  //     $('#uang_makan').val('');
  //     $('#uang_transport').val('');
  //   }
  //   $.ajax({
  //           type: "GET",
  //           url: "get_referensi/"+pegawai, //json get site
  //           dataType : 'json',
  //           success: function(response){
  //               arrData = response;
  //               dataPO=arrData;
                
  //               $('#gaji_pokok').val(arrData['gaji_pokok']);
  //               $('#uang_kehadiran').val(arrData['uang_kehadiran']);
  //               $('#uang_makan').val(arrData['uang_makan']);
  //               $('#uang_transport').val(arrData['uang_transport']);
  //               $('#uang_lembur').val(arrData['uang_lembur']);
  //           }
  //       });
  // }

  function cekGaji(val){
    $('#gaji_pokok').val(formatRupiah(val.value));
  }
  function cekGajiMin(val){
    $('#gaji_min').val(formatRupiah(val.value));
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
  function cekDwd(val){
    $('#denda_weekday').val(formatRupiah(val.value));
  }
  function cekDwe(val){
    $('#denda_weekend').val(formatRupiah(val.value));
  }
  function cekBk(val){
    $('#bonus_kerajinan').val(formatRupiah(val.value));
  }
  function cekPL(val){
    $('#potongan_telat').val(formatRupiah(val.value));
  }
  function cekKM(val){
    $('#kom_min').val(formatRupiah(val.value));
  }
  function cekKL(val){
    $('#kom_level').val(formatRupiah(val.value));
  }
  function cekKT(val){
    $('#kom_trx').val(formatRupiah(val.value));
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