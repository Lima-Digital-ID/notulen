<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><?=$title?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
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
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Scan</th>
                                    <th class="text-center" width="200px">Nama Kurir</th>
                                    <th class="text-center">Tanggal Pickup</th>
                                    <th class="text-center">Tanggal Diterima</th>
                                    <th class="text-center">Status</th>
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
                "url": "<?=base_url('welcome/list_pengiriman_json')?>",
                "type": "POST"
            },
            "aaSorting": [[ 4, "desc" ]],
            "columns": [
                {"data": "barcode_number"},
                {"data": "nama_pegawai"},
                {"data": "send_date", "render": function(data, type, row){return formatDate(row.send_date)}, "class" : 'text-center'},
                {"data": "delivered_date", "render": function(data, type, row){return formatDate(row.delivered_date)}, "class" : 'text-center'},
                {"data": "status", "render": function(data, type, row){return row.status == 1 ? 'Sudah Dikirim' : 'Proses Pengantaran'}},
            ],
        } );
    });
    function formatDate(date) {
        if (date == null) {
            return '-';
        }else{
            var temp=date.split(/[.,\/ -]/);
            return temp[2] + '-' + temp[1] + '-' + temp[0];
        }
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