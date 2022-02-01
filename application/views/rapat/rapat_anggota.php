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
                <div class="card-header">Rapat</div>
                <div class="card-body">
                    <a href="<?=base_url('rapat/add_rapat')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Judulnya</th>
                                    <th class="text-center">Tempat</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Jenis Rapat</th>
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
<script>
    $(document).ready(function(){
       $('#data_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('rapat/rapat_json2')?>",
                "type": "POST"
            },
            "aaSorting": [[ 2, "desc" ]],
            "columns": [
                {"data": "title"},
                {"data": "tempat"},
                {"data": "tanggal", "render": function(data, type, row){return formatDay(row.tanggal)}, "class" : 'text-center'},
                {"data": "tanggal", "render": function(data, type, row){return formatDate(row.tanggal)}, "class" : 'text-center'},
                {"data": "waktu", "class" : 'text-center'},
                {"data": "tipe", "render": function(data, type, row){return jenisRapat(row.tipe)}, "class" : 'text-center'},
                {"data": "id", "class" : 'text-center', "render": function(data, type, row){
                    return '<a '+(row.is_edit != 1 ? 'hidden' : '')+' href="<?=base_url('rapat/tinjau')?>/'+row.id+'" class="btn btn-sm btn-info text-white">Tinjau</a>&nbsp;<a href="<?=base_url('rapat/delete_rapat')?>/'+row.id+'" class="btn text-white btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Hapus</a>&nbsp;<button data-target="#galeri'+row.id+'" data-id="'+row.id+'"  data-toggle="modal" class="btn btn-sm btn-info text-white" >Tambah Galeri</button>&nbsp;<a href="<?=base_url('rapat/daftar_hadir')?>/'+row.id+'" class="btn btn-sm btn-info text-white" target="_blank">Daftar Hadir</a>&nbsp;'+(row.tipe == 1 ? '<a href="<?=base_url('rapat/word')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank">Risalah</a>' : '<a href="<?=base_url('rapat/word_bamus')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-download"></span> Notulen Kegiatan</a>')+'<a href="<?=base_url('rapat/word_bamus')?>/'+row.id+'/false" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-eye"></span> Notulen Kegiatan</a>';
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
        }else if(tipe == 4){
            return 'Banggar'
        }else{
            return ''
        }
    }
</script>