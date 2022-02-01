<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
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
                <div class="card-header">Data Jabatan</div>
                <div class="card-body">
                    <a href="<?=base_url('jabatan/create')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pegawai_list">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Jabatan</th>
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
                "url": "<?=base_url('jabatan/json')?>",
                "type": "POST"
            },
            columns: [
                {
                    "data": "id",
                    "orderable": false
                },{"data": "jabatan"},
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
</script>
