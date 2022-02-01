$(document).ready(function(){
    var a=bulan;
    var str=a.split('-');
    $('#date').html(getMonth(str[1])+' '+str[0]);
    $('#gaji_pokok').html(formatRupiah(gaji_pokok));
    $('#gaji_pokok1').html(formatRupiah(gaji_pokok));
    $('#kom_min').html(formatRupiah(kom_min));
    $('#kom_level').html(formatRupiah(kom_level));
    // $('#grand').html(formatRupiah(grand));
    $('#uang_lembur').html(formatRupiah(uang_lembur));
    $('#jumlah_denda').html(formatRupiah(jumlah_denda));
    $('#komisi_langsung').html(formatRupiah(komisi_langsung));
    // $('#uang_makan').html(formatRupiah(uang_makan));
    // $('#tunjangan').html(formatRupiah(tunjangan));
    // $('#total_kehadiran').html(formatRupiah(total_kehadiran));
    // $('#total_makan').html(formatRupiah(total_makan));
    // $('#total_transport').html(formatRupiah(total_transport));
    // $('#total_lembur').html(formatRupiah(total_lembur));
    // $('#uang_transport').html(formatRupiah(uang_transport));
    // $('#tunjangan1').html(formatRupiah(tunjangan));
    // $('#potongan_telat').html(formatRupiah(potongan_telat));
    // $('#sum_potongan_telat').html(formatRupiah(potongan_telat));
    // $('#potongan').html(formatRupiah(potongan));
    // $('#potongan1').html(formatRupiah(potongan));
    // $('#cicilan').html(formatRupiah(cicilan));
    // $('#sum_cicilan').html(formatRupiah(cicilan));
    // $('#kasbon').html(formatRupiah(kasbon));
    // $('#sum_kasbon').html(formatRupiah(kasbon));

});
function formatRupiah(angka, prefix)
{
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
}
function getMonth(month){
    var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return bulan[month-1];
}
function cekPotongan(val){
    $('#jml_potongan').val(formatCurrency(val.value));
}
function cekCicilan(val){
    $('#jml_cicilan').val(formatCurrency(val.value));
}
function cekKasbon(val){
    $('#jml_kasbon').val(formatCurrency(val.value));
}
function cekKomisi(val){
    $('#komisi').val(formatCurrency(val.value));
}
function formatCurrency(angka, prefix)
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