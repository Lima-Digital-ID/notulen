<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
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
                    <form class="form-horizontal form-bordered" action="<?php echo $action; ?>" method="post">
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id" id="id" placeholder="id" value="<?php echo $id; ?>" />
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                               Jabatan <?php echo form_error('jabatan') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('hrms/pegawai') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
$(document).ready(function(){
    anggotaOption()
});
function anggotaOption(){
    var id_pegawai=$('#id_pegawai')
    id_pegawai.empty()
    id_pegawai.append('<option value="">Pilih Anggota</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('user/list_anggota')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    id_pegawai.append('<option '+(<?=$id_pegawai != null ? $id_pegawai : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
</script>
