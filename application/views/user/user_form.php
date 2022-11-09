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
                        <div class="form-group row" hidden>
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                ID Pegawai <?php echo form_error('id') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="id" id="id" placeholder="ID Pegawai Auto Number" readonly="true" value="<?php echo $id; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                               Username <?php echo form_error('username') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Email <?php echo form_error('email') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Password <?php echo form_error('password') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Nama Anggota
                            </label>
                            <div class="col-lg-6">
                                <select name="id_pegawai" id="id_pegawai" class="form-control select2" style="width:100%">
                                
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Role
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control" name='role'>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="1" <?=$role == 1 ? 'selected' : ''?>>Admin</option>
                                    <option value="2" <?=$role == 2 ? 'selected' : ''?>>Anggota</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
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
