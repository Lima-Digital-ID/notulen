<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            
        </div>
    </div>
</div>

 <?php
 function formatTime($time){
    $jam=strtotime($time);
    return date('H:i', $jam);
 }
 ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?=$title?></div>
                <div class="card-body">
                    <a href="<?=base_url('Sidak/add')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Tempat</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Jenis Tinjauan Lapangan</th>
                                    <th class="text-center" width="200px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalAbsensi" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Daftar hadir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="daftar_hadir" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Waktu</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<?php 
    $jenis = isset($_GET['jenis']) ?  "?jenis=$_GET[jenis]" : "";
    $sub = isset($_GET['sub']) ?  "?jenis=$_GET[jenis]&sub=$_GET[sub]" : "";
?>
<script>
    $(document).ready(function(){
       $('#data_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('sidak/sidak_json'.$jenis.$sub)?>",
                "type": "POST"
            },
            "aaSorting": [[ 1, "desc" ]],
            "columns": [
                {"data": "nama"},
                {"data": "sub_tipe", "class" : 'text-center'},
                {"data": "awal_waktu_pelaksanaan", "render": function(data, type, row){return formatDay(row.awal_waktu_pelaksanaan)}, "class" : 'text-center'},
                {"data": "awal_waktu_pelaksanaan", "render": function(data, type, row){return formatDate(row.awal_waktu_pelaksanaan)}, "class" : 'text-center'},
                {"data": "waktu", "class" : 'text-center'},
                {"data": "jenis_kunjungan", "render": function(data, type, row){return jenisKunjungan(row.jenis_kunjungan)}, "class" : 'text-center'},
                {"data": "id", "class" : 'text-center', "render": function(data, type, row){
                    return '<a '+(row.is_edit != 1 ? 'hidden' : '')+' href="<?=base_url('sidak/tinjau')?>/'+row.id+'" class="btn btn-sm btn-info text-white">Tinjau</a>&nbsp;<a href="<?=base_url('sidak/delete')?>/'+row.id+'" class="btn text-white btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Hapus</a>&nbsp;<button type="button" class="btn btn-primary btn-sm" data-target="#modalAbsensi" data-id="'+row.id+'" onclick="getAbsensi(this)" data-toggle="modal">Daftar Hadir</button>&nbsp;<a href="<?=base_url('sidak/word')?>/'+row.id+'/false" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-eye"></span> Laporan</a>&nbsp;<a href="<?=base_url('sidak/word')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-download"></span> Laporan</a>&nbsp;'+(row.jenis_kunjungan == 1  ? '<a href="<?=base_url('sidak/word_hearing')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank">Laporan Hearing</a>' : '');
                }}
            ],
        } );
    });
    function formatMonth(date) {
      var temp=date.split(/[.,\/ -]/);
      return temp[1] + '-' + temp[0];
    }
    function formatDate(date) {
      var temp=date.split(/[.,\/ -]/);
      return temp[2] + '-' + temp[1] + '-' + temp[0];
    }
    function formatDate2(date){
        if (date == null) {
            return '-';
        }else{

            var myDate = new Date(date);
            var tgl=date.split(/[ -]+/);
            var output = tgl[2] + "-" +  tgl[1] + "-" + tgl[0] + ' ' + tgl[3];
            return output;
        }
    }
    function jenisKunjungan(jenis){
        if (jenis == 1) {
            return 'Paripurna';
        }else if(jenis == 2){
            return 'Komisi'
        }else if(jenis == 3){
            return 'Bamus'
        }
        else if(jenis == 4){
            return 'Banggar'
        }
        else if(jenis == 5){
            return 'Fraksi'
        }
        else if(jenis == 6){
            return 'Badan'
        }
        else{
            return ''
        }
    }
    function getAbsensi(eq){
        var id=$(eq).data('id')
        t = $('#daftar_hadir').DataTable();
        t.clear().draw(false);
        $.ajax({
            type: "get",
            url: '<?=base_url('sidak/get_absensi')?>'+'/'+id, //json get site
            dataType : 'json',
            success: function(response){
                arrData = response['data'];
                var j=0;
                for(i = 0; i < arrData.length; i++){
                    t.row.add([
                        '<div class="text-left">'+arrData[i]['nama_pegawai']+'</div>',
                        '<div class="text-left">'+formatDate2(arrData[i]['waktu'])+'</div>',
                    ]).draw(false);
                }
            }
        });
    }
</script>