<style>
.badge{
    color : white;
}
</style>
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
    </div>
</div>
 <?php
 function formatTime($time){
     $jam=strtotime($time);
     return date('H:i', $jam);
    }
    ?>
<div class="container-fluid">
    <?php 
        if($this->session->flashdata('successMsg')){
    ?>
        <div class="alert alert-success">
            <strong><?= $this->session->flashdata('successMsg') ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php            
        }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?= $title ?></div>
                <div class="card-body">
                    <?php $filterTipe = isset($_GET['tipe']) ? "?tipe=".$_GET['tipe'] : "" ?>
                    <?php $filterSub = isset($_GET['sub']) ? "&sub=".$_GET['sub'] : "" ?>
                    <a href="<?=base_url('rapat/add_rapat').$filterTipe.$filterSub?>"><button class="btn-primary btn btn-md">Tambah</button></a>
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
                                    <th class="text-center">Jenis Rapat</th>
                                    <th class="text-center">Status Daftar Hadir</th>
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
<?php $db= $this->db->query("SELECT * FROM rapat")->result();
foreach($db as $a) { ?>
<div id="galeri<?= $a->id ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Galeri</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="<?= base_url('rapat/upload_galeri') ?>" method="post"  enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="id" value="<?= $a->id ?>" name="id">
                   <div class="form-group">
                            <label for="">Galeri Rapat</label>
                            <input type="file" class="form-control" name="files[]" id="files" multiple=""  accept="application/pdf,application/vnd.ms-excel,image/*">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect">Simpan</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<?php 
    $idRapat = isset($_GET['id_rapat']) ? "?id_rapat=$_GET[id_rapat]" : "";
    $tipe = isset($_GET['tipe']) ?  "?tipe=$_GET[tipe]" : "";
    $sub = isset($_GET['sub']) ?  "?tipe=$_GET[tipe]&sub=$_GET[sub]" : "";
?>
<script>
    $(document).ready(function(){
       $('#data_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('rapat/rapat_json'.$idRapat.$tipe.$sub)?>",
                "type": "POST",
            },
            "aaSorting": [[ 2, "desc" ]],
            "columns": [
                {"data": "title"},
                {"data": "tempat"},
                {"data": "tanggal", "render": function(data, type, row){return formatDay(row.tanggal)}, "class" : 'text-center'},
                {"data": "tanggal", "render": function(data, type, row){return formatDate(row.tanggal)}, "class" : 'text-center'},
                {"data": "waktu", "class" : 'text-center'},
                {"data": "tipe", "render": function(data, type, row){return jenisRapat(row.tipe)}, "class" : 'text-center'},
                {"data": "status_absen", "render": function(data, type, row){
                    return row.ttl_absen==row.ttl_anggota ? "<span class='badge badge-success'><i class='fa fa-check-circle'></i> Daftar Hadir Lengkap</span>" : "<span class='badge badge-danger'><i class='fa fa-exclamation-triangle'></i>  Daftar Hadir Belum Lengkap</span>"
                }, "class" : 'text-center'},
                {"data": "id", "class" : 'text-center', "render": function(data, type, row){
                    var preview = ""
                    var download = ""
                    $.ajax({
                        url : "<?php echo base_url()."rapat/jsonTipePegawai" ?>",
                        dataType : "json",
                        async : false,
                        success : function(data){
                            $.each(data,function(i,v){
                                preview+="<a href='<?php echo base_url()."rapat/daftar_hadir/"?>"+row.id+"?id_tipe="+v.id_tipe+"' class='dropdown-item'>"+v.tipe+"</a>";
                                download+="<a href='<?php echo base_url()."rapat/daftar_hadir/"?>"+row.id+"?id_tipe="+v.id_tipe+"&word=true' class='dropdown-item'>"+v.tipe+"</a>";
                            })
                            setTipePegawai(preview,download)
                        }
                    })
                    function setTipePegawai(paramPreview,paramDownload){
                        preview = paramPreview
                        download = paramDownload
                    }
                    return '<a href="<?= base_url()."absensi?id_rapat=" ?>'+row.id+'&allow=true" class="btn btn-info btn-sm">Daftar Hadir</a> <a '+(row.is_edit != 1 ? 'hidden' : '')+' href="<?=base_url('rapat/tinjau')?>/'+row.id+'" class="btn btn-sm btn-info text-white">Buat Notulen</a>&nbsp;'+(row.tipe == 1 ? '<a href="<?=base_url('rapat/word')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank">Notulen</a>' : '<a href="<?=base_url('rapat/word_bamus')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-download"></span> Download Notulen</a>')+'&nbsp;<a href="<?=base_url('rapat/word_bamus')?>/'+row.id+'/false" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-eye"></span> Print & Preview Notulen</a><div class="dropdown"><button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Download Daftar Hadir</button><div class="dropdown-menu">'+download+'</div></div><div class="dropdown"><button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Print & Preview Daftar Hadir</button><div class="dropdown-menu">'+preview+'</div></div>&nbsp;<a href="<?=base_url('rapat/edit_rapat')?>/'+row.id+'" class="btn text-white btn-sm btn-warning">Edit</a>&nbsp;<a href="<?=base_url('rapat/delete_rapat')?>/'+row.id+'" class="btn text-white btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Hapus</a>';
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
    function jenisRapat(tipe){
        if (tipe == 1) {
            return 'Paripurna';
        }else if(tipe == 2){
            return 'Komisi'
        }else if(tipe == 3){
            return 'Bamus'
        }
        else if(tipe == 4){
            return 'Banggar'
        }
        else if(tipe == 5){
            return 'Fraksi'
        }
        else if(tipe == 6){
            return 'Badan'
        }
        else{
            return ''
        }
    }
</script>