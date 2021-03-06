<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Anggota</li>
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
                <div class="card-header"><?= $title ?></div>
                <div class="card-body">
                    <a href="<?=base_url('pegawai/create')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <?php echo anchor(site_url('pegawai/import_excel'), '<i class="fa fa-upload" aria-hidden="true"></i> Import Pegawai', 'class="hide btn btn-success"'); ?>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pegawai_list">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Partai</th>
                                    <th>Komisi</th>
                                    <th>Badan</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $('#pegawai_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('pegawai/json_dprd')?>",
                "type": "POST",
                "data" : {tipe : "<?= $_GET['tipe'] ?>"}
            },
            columns: [
                {"data": "nama_pegawai"},
                {"data": "nama_partai"},
                {"data": "nama_komisi"},
                {"data": "nama_badan"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
        } );
    });
    function formatDate(date) {
      var temp=date.split(/[.,\/ -]/);
      return temp[2] + '-' + temp[1] + '-' + temp[0];
    }
    function getKategori(val){
        if(val == 1){
            return 'Anggota Dewan'
        }else if(val == 2){
            return 'Forkopimda'
        }else{
            return 'Sekretaris Dewan'
        }
    }
</script>
