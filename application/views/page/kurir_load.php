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
                <div class="card-header">Bawaan Kurir</div>
                <div class="card-body">
                    <a href="<?=base_url('welcome/add_kurir_load')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Nama Kurir</th>
                                    <th class="text-center">Otorisasi</th>
                                    <th class="text-center">Tanggal Pengiriman</th>
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
<div class="modal fade bs-example-modal-lg" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="zero_config3" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                "url": "<?=base_url('/welcome/json_kurir_load')?>",
                "type": "POST"
            },
            "aaSorting": [[ 4, "desc" ]],
            "columns": [
                {"data": "id"},
                {"data": "nama_pegawai"},
                {"data": "username"},
                {"data": "send_date", "class" : 'text-center',  "render": function(data, type, row){return formatDate(row.send_date)}},
                {"data": "id", "render": function(data, type, row){
                    return '<button data-toggle="modal" data-target="#modalDetail" onclick="showDetail(this)" data-id="'+row.id+'" class="btn btn-sm btn-info">Detail</button>&nbsp;<a href="<?=base_url('welcome/print_surat')?>/'+row.id+'" class="btn btn-sm btn-success text-white" target="_blank">Cetak</a>&nbsp;<a href="<?=base_url('welcome/delete_kurir_load')?>/'+row.id+'" class="btn text-white btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Hapus</a>';
                }}
            ],
        });
    });
    function formatDate(date) {
      var temp=date.split(/[.,\/ -]/);
      return temp[2] + '-' + temp[1] + '-' + temp[0];
    }
    function showDetail(eq){
        var t3 = $('#zero_config3').DataTable();
        var id=$(eq).data('id');
        t3.clear().draw(false);
        $.ajax({
            "url" : "<?=base_url('/welcome/json_kurir_load_d')?>"+'/'+id,
            "dataType" : 'json',
            'type'  : 'GET',
            success : function(response){
                arrData = response;
                for(i = 0; i < arrData.length; i++){
                    t3.row.add([
                        '<div class="text-left">'+arrData[i]['barcode_number']+'</div>',
                        '<div class="text-left">'+(arrData[i]['status'] == '1' ? 'Sudah Dikirim' : 'Proses Pengantaran')+'</div>'
                    ]).draw(false);
                }
            }
        })
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