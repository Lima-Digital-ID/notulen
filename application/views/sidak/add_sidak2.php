<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Sidak</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="mt-4" action="<?=base_url('sidak/add_action')?>" method="post" id="form_add" autocomplete="off"  enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required autofocus>
                        </div>     
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Awal Pelaksanaan</label>
                                    <input type="text" class="form-control dateFormat" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" >
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Ahir Pelaksanaan</label>
                                    <input type="text" class="form-control dateFormat" id="tanggal2" name="tanggal2" placeholder="dd/mm/yyyy" >
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="time" class="form-control" name="waktu" >
                                </div>   
                            </div>
                        </div>          
                        <div class="row" >
                            <div class="col-6" style="display: none;">
                                <div class="form-group">
                                    <label for="">Tipe Kunjungan</label>
                                    <select name="tipe" id="tipe" class="form-control select2" style="width:100%">
                                        <option value="1">Kunjungan Kerja</option>
                                        <option value="2">Hearing</option>
                                        <option value="3" selected>Sidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Sub Tipe Kunjungan</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" data-target="#modalAddSubTipe" data-toggle="modal" style="margin-top:5px"><i class="fa fa-plus"></i></button>
                                    <select name="sub_tipe" id="sub_tipe" class="form-control select2" style="width:100%">
                                    </select>
                                </div>
                                <div class="form-group">
                            <label for="">Galeri Rapat</label>
                            <input type="file" class="form-control" name="files[]" id="files" multiple=""  accept="application/pdf,application/vnd.ms-excel,image/*">
                        </div>  
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalAddSubTipe" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_sub_tipe" action="javascript:;" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Sub Tipe Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
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
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/moment/moment.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/ckeditor/ckeditor.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/ckeditor/samples/js/sample.js"></script>
<script>
$('.dateFormat').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
$(document).ready(function(){
    subOption();
    $("form#form_sub_tipe").on("submit", function( event ) {
        event.preventDefault();
        var response_data=null;
        $.ajax({
            type: "POST",
            url: "<?= base_url('sidak/add_sub_tipe')?>", //json get site
            dataType : 'json',
            data: $('#form_sub_tipe').serialize(),
            success: function(response){
                subOption();
            }
        });
        $('#modalAddSubTipe').modal('hide');
        
    });
});

function subOption(){
    var sub_tipe=$('#sub_tipe')
    sub_tipe.empty()
    sub_tipe.append('<option value="">Pilih Sub Tipe Kunjungan</option>')
    $.ajax({
        type: "get",
        url: "<?= base_url('sidak/sub_tipe')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    sub_tipe.append('<option value="'+response_data[i]['id']+'">'+response_data[i]['nama']+'</option>')
                }
            }
        }
    });
}
</script>