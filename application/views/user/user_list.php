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
                <div class="card-header">Data User</div>
                <div class="card-body">
                    <a href="<?=base_url('user/create')?>"><button class="btn-primary btn btn-md">Tambah</button></a>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pegawai_list">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Nama Pegawai</th>
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
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };
         
       $('#pegawai_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "orderable":false,
            "ajax": {
                "url": "<?=base_url('user/json')?>",
                "type": "POST"
            },
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            },            
            columns: [
                {"data": "username"},
                {"data": "username"},
                {"data": "email"},
                {"data": "nama_pegawai",},
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
