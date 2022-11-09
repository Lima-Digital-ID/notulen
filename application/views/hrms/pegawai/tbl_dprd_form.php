<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Anggota</a></li>
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
                    <?php echo form_open_multipart($action) ?>
                        <div class="form-group row" hidden>
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                ID Pegawai <?php echo form_error('id_pegawai') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="id_pegawai" id="id_pegawai" placeholder="ID Pegawai Auto Number" readonly="true" value="<?php echo $id_pegawai; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                               Nama Anggota
                            </label>
                            <div class="col-lg-6">
                               <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Anngota" value="<?php echo $nama_pegawai; ?>" required />
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                               NIP
                            </label>
                            <div class="col-lg-6">
                               <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?php echo $nip; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                               NIA
                            </label>
                            <div class="col-lg-6">
                               <input type="text" class="form-control" name="nia" id="nia" placeholder="NIA" value="<?php echo $nia; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Kategori
                            </label>
                            <div class="col-lg-6">
                                <select name="tipe" id="tipe" class="form-control select2" style="width:100%" required  onchange="cekKategori()">
                                    <option value="" <?=$tipe == '' ? 'selected' : ''?>>--Pilih Kategori--</option>
                                    <?php 
                                        foreach ($getTipe as $key => $value) {
                                            $selected  = $tipe==$value['id_tipe'] ? 'selected' : '';
                                            echo "<option data-kategori='$value[kategori]' value='$value[id_tipe]' $selected>$value[tipe]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Upload Tanda Tangan
                            </label>
                            <div class="col-lg-6">
                            <?php 
                            //when edit
                                $required = "required";
                                if(isset($infoTtd)){
                                    $required = "";
                            ?>
                            <img src="<?php echo base_url()."assets/images/upload-ttd/".$ttd ?>" alt="" width="200px">
                            <br>
                            <?php } ?>
                                <?php echo isset($infoTtd) ? "<small style='color:red'>$infoTtd</small>" : "" ?>
                                <input type="file" name="ttd" class="form-control" id="" <?=$required?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Jabatan
                            </label>
                            <div class="col-lg-6">
                                <select name="id_jabatan[]" multiple="multiple"  class="form-control select2" style="width:100%" required  onchange="cekKategori()">
                                    <!-- <option value="" <?=$tipe == '' ? 'selected' : ''?>>--Pilih Kategori--</option> -->
                                    <!-- <option value="2">Sekretariat DPRD</option> -->
                                    <?php
                                        foreach ($allJab as $key => $value) {
                                            $selected  = in_array($value->id,$id_jabatan)  ? 'selected' : '';
                                            echo "<option value='$value->id' $selected>$value->jabatan</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="row_partai"hidden>
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Partai
                            </label>
                            <div class="col-lg-6">
                                <select name="id_partai" id="id_partai" class="form-control select2" style="width:100%">
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-primary btn-sm" data-target="#modalAddPartai" data-toggle="modal" style="margin-top:5px"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row" id="row_komisi">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Komisi
                            </label>
                            <div class="col-lg-6">
                                <select name="id_komisi" id="id_komisi" class="form-control select2" style="width:100%">
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-primary btn-sm" data-target="#modalAddKomisi" data-toggle="modal" style="margin-top:5px"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row" id="row_badan">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Badan
                            </label>
                            <div class="col-lg-6">
                                <select name="id_badan" id="id_badan" class="form-control select2" style="width:100%">
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-primary btn-sm" data-target="#modalAddbadan" data-toggle="modal" style="margin-top:5px"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalAddPartai" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_partai" action="javascript:;" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Partai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <label for="">Partai</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect">Simpan</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="modalAddKomisi" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_komisi" action="javascript:;" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Komisi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <label for="">Komisi</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect">Simpan</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="modalAddbadan" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_badan" action="javascript:;" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Banggar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="nama" required>
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
<script>
    $(document).ready(function(){
        $("form#form_partai").on("submit", function( event ) {
            event.preventDefault();
            var response_data=null;
            $.ajax({
                type: "POST",
                url: "<?= base_url('welcome/add_partai')?>", //json get site
                dataType : 'json',
                data: $('#form_partai').serialize(),
                success: function(response){
                    response_data=response;
                }
            });
            $('#modalAddPartai').modal('hide');
            reloadPartaiOption();
            alert('Berhasil')
        });
        $("form#form_komisi").on("submit", function( event ) {
            event.preventDefault();
            var response_data=null;
            $.ajax({
                type: "POST",
                url: "<?= base_url('welcome/add_komisi')?>", //json get site
                dataType : 'json',
                data: $('#form_komisi').serialize(),
                success: function(response){
                    response_data=response;
                }
            });
            $('#modalAddKomisi').modal('hide');
            reloadKomisiOption();
            alert('Berhasil')
        });
        $("form#form_badan").on("submit", function( event ) {
            event.preventDefault();
            var response_data=null;
            $.ajax({
                type: "POST",
                url: "<?= base_url('welcome/add_badan')?>", //json get site
                dataType : 'json',
                data: $('#form_badan').serialize(),
                success: function(response){
                    response_data=response;
                }
            });
            $('#modalAddbadan').modal('hide');
            reloadBadanOption();
            alert('Berhasil')
        });
        cekKategori();
    });
    function reloadPartaiOption(){
        var partai_option=$('#id_partai')
        partai_option.empty()
        partai_option.append('<option value="">Pilih Partai</option>')
        $.ajax({
            type: "get",
            url: "<?= base_url('welcome/partai_option')?>", //json get site
            dataType : 'json',
            success: function(response){
                response_data=response['data'];
                if(response_data != null){
                    for(i=0; i < response_data.length; i++){
                        partai_option.append('<option '+(<?=$id_partai != null ? $id_partai : 0?> == response_data[i]['id'] ? 'selected' : '')+' value="'+response_data[i]['id']+'">'+response_data[i]['nama']+'</option>')
                    }
                }
            }
        });
    }
    function reloadKomisiOption(){
        var komisi_option=$('#id_komisi')
        komisi_option.empty()
        komisi_option.append('<option value="">Pilih Komisi</option>')
        $.ajax({
            type: "get",
            url: "<?= base_url('welcome/komisi_option')?>", //json get site
            dataType : 'json',
            success: function(response){
                response_data=response['data'];
                if(response_data != null){
                    for(i=0; i < response_data.length; i++){
                        komisi_option.append('<option '+(<?=$id_komisi != null ? $id_komisi : 0?> == response_data[i]['id'] ? 'selected' : '')+' value="'+response_data[i]['id']+'">'+response_data[i]['nama']+'</option>')
                    }
                }
            }
        });
    }
    function reloadBadanOption(){
        var banggar_option=$('#id_badan')
        banggar_option.empty()
        banggar_option.append('<option value="">Pilih Badan</option>')
        $.ajax({
            type: "get",
            url: "<?= base_url('welcome/badan_option')?>", //json get site
            dataType : 'json',
            success: function(response){
                response_data=response['data'];
                if(response_data != null){
                    for(i=0; i < response_data.length; i++){
                        banggar_option.append('<option '+(<?=$id_badan != null ? $id_badan : 0?> == response_data[i]['id'] ? 'selected' : '')+' value="'+response_data[i]['id']+'">'+response_data[i]['nama']+'</option>')
                    }
                }
            }
        });
    }
    function cekKategori(){
        val=$('#tipe').find(':selected').attr('data-kategori'); //
        if(val != 2){
            $('#row_partai').show();
            $('#row_fraksi').show();
            $('#row_komisi').show();
            $('#row_bamus').show();
            $('#row_banggar').show();
            $('#row_badan').show();
            reloadPartaiOption();
            reloadKomisiOption();
            reloadBadanOption();
        // }else{
        //     $('#row_partai').hide();
        //     $('#row_komisi').hide();
        //     $('#row_badan').hide();
        //     $('#id_partai').val('');
        //     $('#id_komisi').val('');
        //     $('#id_badan').val('');
        }
    }
</script>
