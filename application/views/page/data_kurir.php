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
                    <a href="<?=base_url('welcome/scan_deliver')?>"><button class="btn-primary btn btn-md">Tambah Laporan</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Scan</th>
                                    <th class="text-center" width="200px">Bulan</th>
                                    <th class="text-center">Tanggal Pickup</th>
                                    <th class="text-center">Tanggal Diterima</th>
                                    <th class="text-center">Status Pengiriman</th>
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
       var table = $('#data_list').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?=base_url('welcome/json_data_kurir')?>",
                        "type": "POST"
                    },
                    "aaSorting": [[ 7, "desc" ]],
                    "columns": [
                        {"data": "barcode_number"},
                        {"data": "month", "render": function(data, type, row){return formatMonth(row.month)}, "class" : 'text-center'},
                        {"data": "send_date", "render": function(data, type, row){return formatDate(row.send_date)}, "class" : 'text-center'},
                        {"data": "delivered_date", "render": function(data, type, row){return formatDate(row.delivered_date)}, "class" : 'text-center'},
                        {"data": "status", "render": function(data, type, row){return row.status == 1 ? 'Sudah Dikirim' : 'Proses Pengantaran'}},
                    ],
                });
    });
    function formatMonth(date) {
      var temp=date.split(/[.,\/ -]/);
      return temp[1] + '-' + temp[0];
    }
    function formatDate(date) {
        if (date == null) {
            return '-';
        }else{
            var temp=date.split(/[.,\/ -]/);
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
    }
</script>