<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Rapat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bamus</li>
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
                <div class="col-md-2">
                <select class="form-control labaRugiFilter" data-other='#bulan' name="tahun" id="tahun" required>
                    <?php 
                        $yearNow = (int)date('Y');
                        for($i=$yearNow;$i<=$yearNow+2;$i++){
                            echo "<option>$i</option>";
                        }
                    ?>
                </select>
            </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="userTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Tempat</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th  class="text-center">Jenis Rapat</th>
                                    <th  class="text-center" width="200px">Action</th>
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
       var userDataTable = $('#data_list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('rapat/rapatbamus_json')?>",
                "data": function (data) {
                    data.tahun = $('#tahun').val();
                    console.log(data);
                }
                "type": "POST"
            },
            "aaSorting": [[ 2, "desc" ]],
            "columns": [
                {"data": "title"},
                {"data": "tempat"},
                {"data": "tanggal", "render": function(data, type, row){return formatDay(row.tanggal)}, "class" : 'text-center'},
                {"data": "tanggal", "render": function(data, type, row){return formatDate(row.tanggal)}, "class" : 'text-center'},
                {"data": "waktu", "class" : 'text-center'}
            ],
        } );

        $('#tahun').change(function() {
            userDataTable.draw();
        });
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
<script type="text/javascript">
    $(document).ready(function() {
        var userDataTable = $('#userTable').DataTable({
            //   'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>Rapat/rapat_json5',
                'data': function(data) {
                    data.tahun = $('#tahun').val();
                    // data.searchNama = $('#sel_naama').val();
                    console.log(data);
                }

            },
            'columns': [
                {"data": "title"},
                {"data": "tempat"},
                {"data": "tanggal", "render": function(data, type, row){return formatDay(row.tanggal)}, "class" : 'text-center'},
                {"data": "tanggal", "render": function(data, type, row){return formatDate(row.tanggal)}, "class" : 'text-center'},
                {"data": "waktu", "class" : 'text-center'},
                {"data": "tipe", "render": function(data, type, row){return jenisRapat(row.tipe)}, "class" : 'text-center'},
                {"data": "id", "class" : 'text-center', "render": function(data, type, row){
                    return '<a '+(row.is_edit != 1 ? 'hidden' : '')+' href="<?=base_url('rapat/tinjau')?>/'+row.id+'" class="btn btn-sm btn-info text-white">Tinjau</a>&nbsp;<a href="<?=base_url('rapat/delete_rapat')?>/'+row.id+'" class="btn text-white btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');">Hapus</a>&nbsp;<a href="<?=base_url('rapat/daftar_hadir')?>/'+row.id+'" class="btn btn-sm btn-info text-white" target="_blank">Daftar Hadir</a>&nbsp;'+(row.tipe == 1 ? '<a href="<?=base_url('rapat/word')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank">Risalah</a>' : '<a href="<?=base_url('rapat/word_bamus')?>/'+row.id+'" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-download"></span> Notulen Kegiatan</a>')+'<a href="<?=base_url('rapat/word_bamus')?>/'+row.id+'/false" class="btn btn-sm btn-primary text-white" target="_blank"><span class="fa fa-eye"></span> Notulen Kegiatan</a>';
                }}
            ]
        });

        $('#tahun').change(function() {
            userDataTable.draw();
        });
        $('#searchName').keyup(function() {
            userDataTable.draw();
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

       function jenisRapat(tipe) {
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
    
    });
</script>   