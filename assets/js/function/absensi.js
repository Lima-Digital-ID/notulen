$(document).ready(function() {
if (typeof bulan != 'undefined') {
    $('#bulan').val(bulan).change();
    $('#tahun').val(tahun).change();
}
t = $('#mytable').DataTable();
    t.clear().draw(false);
    $.ajax({
        type: "GET",
        url: "absensi/json", //json get site
        dataType : 'json',
        success: function(response){
            arrData = response['data'];
            var j=0;
            for(i = 0; i < arrData.length; i++){
                j+=1;
                t.row.add([
                    '<div class="text-center">'+j+'</div>',
                    '<div class="text-left">'+arrData[i]['nama_pegawai']+'</div>',
                    '<div class="text-left">'+formatDate(arrData[i]['tanggal'])+'</div>',
                    '<div class="text-left">'+formatTime(arrData[i]['jam_datang'])+'</div>',
                    '<div class="text-left">'+formatTime(arrData[i]['jam_pulang'])+'</div>',
                    '<div class="text-left">'+
                    '<a href="'+uri+'hrms/absensi/update/'+arrData[i]['id_pegawai']+'/'+arrData[i]['tanggal']+'" class="btn waves-effect waves-light btn-xs btn-success" title="edit"><i class="fa fa-edit"></i></a> '+
                    // '<a href="<?=site_url('hrms/absensi/detail/')?>'+arrData[i]['id_pegawai']+'" class="btn waves-effect waves-light btn-xs btn-info"><i class="fa fa-list"></i></a>'+
                    '</div>'
                ]).draw(false);
            }
        }
    });
});
function cekAbsensiDate(){
    var id=$('#date').val();
    var temp=id.split('-');
    var newDate=temp[2]+'-'+temp[1]+'-'+temp[0];
    console.log(newDate);
   t = $('#mytable').DataTable();
    t.clear().draw(false);
    $.ajax({
        type: "post",
        url: "absensi/json", //json get site
        dataType : 'json',
        data :{ date : newDate},
        success: function(response){
            arrData = response['data'];
            var j=0;
            for(i = 0; i < arrData.length; i++){
                j+=1;
                t.row.add([
                    '<div class="text-center">'+j+'</div>',
                    '<div class="text-left">'+arrData[i]['nama_pegawai']+'</div>',
                    '<div class="text-left">'+formatDate(arrData[i]['tanggal'])+'</div>',
                    '<div class="text-left">'+formatTime(arrData[i]['jam_datang'])+'</div>',
                    '<div class="text-left">'+formatTime(arrData[i]['jam_pulang'])+'</div>',
                    '<div class="text-center">'+
                    '<a href="'+uri+'hrms/absensi/update/'+arrData[i]['id_pegawai']+'/'+arrData[i]['tanggal']+'" class="btn waves-effect waves-light btn-xs btn-success"><i class="fa fa-edit"></i></a> '+
                    // '<a href="'+uri+'hrms/absensi/detail/'+arrData[i]['id_pegawai']+'" class="btn waves-effect waves-light btn-xs btn-info"><i class="fa fa-list"></i></a>'+
                    '</div>'
                ]).draw(false);
            }
        }
    });
}
function formatDate(date) {
  var temp=date.split('-');
  return temp[2] + '-' + temp[1] + '-' + temp[0];
}
function formatTime(time) {
    if (time != '') {
        var tempTime=time.split(':');
        return tempTime[0] + ':' + tempTime[1];
    }else{
        return '-';
    }
}
function formatUL(val){
    $('#uang_lembur').val(formatRupiah(val.value));
}
function formatRupiah(angka, prefix){
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