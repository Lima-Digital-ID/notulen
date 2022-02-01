<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a href="<?=base_url('welcome/add_product')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Scan</th>
                                    <th class="text-center" width="200px">Bulan</th>
                                    <th class="text-center">Tanggal Pickup</th>
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
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $('#data_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('welcome/json')?>",
                "type": "POST"
            },
            "aaSorting": [[ 2, "desc" ]],
            "columns": [
                {"data": "barcode_number"},
                {"data": "month", "render": function(data, type, row){return formatMonth(row.month)}, "class" : 'text-center'},
                {"data": "date_in", "render": function(data, type, row){return formatDate(row.date_in)}, "class" : 'text-center'},
                {"data": "id", "render": function(data, type, row){
                    return '<a hidden class="btn btn-sm btn-info text-white">Edit</a> &nbsp; <a href="<?=base_url('welcome/delete_product')?>/'+row.id+'" class="btn text-white btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Hapus</a>';
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
</script>