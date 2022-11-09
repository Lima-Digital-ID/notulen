<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Kunjungan</a></li>
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
                    <form class="mt-4" action="<?=base_url('kunjungan/add_action')?>" method="post" id="form_add" autocomplete="off"  enctype="multipart/form-data">
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
                                    <input type="text" id="waktu" class="form-control" name="waktu" >
                                </div>   
                            </div>
                        </div>          
                        <div class="row">
                            <!-- <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tipe Kunjungan</label>
                                    <select name="tipe" id="tipe" class="form-control" style="width:100%" readonly="true">
                                        <option value="1">Kunjungan Kerja</option> -->
                                        <!-- <option value="2">Hearing</option>
                                        <option value="3">Sidak</option> -->
                                    <!-- </select> -->
                                <!-- </div> -->
                            <!-- </div> --> 
                            <div class="col-6">
                            <input type="hidden" name="tipe" id="tipe" value='1'>

                                <div class="form-group">
                                    <label for="">Jenis Kunjungan</label>
                                    <select name="jenis" id="jenis" class="form-control select2" style="width:100%">
                                    <option data-val="" data-sub="0" value="0">---Pilih Jenis---</option>
                                    <?php 
                                            foreach ($menuKunjungan as $value) {
                                    ?>
                                    <option data-val="<?= $value['menu'] ?>" data-sub="<?= $value['is_sub'] ?>" value="<?php echo $value['id_menu'] ?>"><?php echo $value['menu'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" id="sub_jenis" style="display:none">
                                <div class="form-group">
                                    <label for="">Sub Jenis Kunjungan</label>
                                    <select name="sub_jenis" id="sub" class="form-control select2" style="width:100%;">
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Daerah Kunjungan</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" data-target="#modalAddSubTipe" data-toggle="modal" style="margin-top:5px"><i class="fa fa-plus"></i></button>
                                    <select name="sub_tipe" id="sub_tipe" class="form-control select2" style="width:100%">
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                        <!--    <div class="form-group">-->
                        <!--    <label for="">Galeri Rapat</label>-->
                        <!--    <input type="file" class="form-control" name="files[]" id="files" multiple=""  accept="application/pdf,application/vnd.ms-excel,image/*">-->
                        <!--</div>  -->
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-5"><hr></div><div class="col-md-2"><center style="margin-top:5px"><h5>Peserta Kunjungan</h5></center></div><div class="col-md-5"><hr></div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <div class="col-6">
                           
                            <label for="">Anggota DPRD</label>
                                <select name="id_anggota[]" multiple id="row_anggota" style="width:100%" class="select2 form-control"></select>
                            </div>
                            
                            <div class="col-6" id="mitra">
                                <label for="">Mitra Kerja</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" data-target="#modalAddForkopimda" data-toggle="modal" style="margin-top:5px"><i class="fa fa-plus"></i></button>
                           
                                <select name="id_anggota[]" multiple id="row_forkopimda" style="width:100%" class="select2 form-control"></select>
                            </div>
                            <div class="col-6">
                            <label for="" class="mt-3">Sekretaris Dewan</label>
                                <select name="sekretaris" id="row_sekwan" style="width:100%" class="select2 form-control"></select>
                            </div>
                            <div class="col-6">
                            <label for="" class="mt-3">Pelapor</label>
                                <select name="pelapor" id="pelapor" style="width:100%" class="select2 form-control">
                                <option value="">---Pilih Pelapor---</option>
                                <?php 
                                    foreach ($pegawai as $key => $value) {
                                        echo "<option value='$value[id_pegawai]'>$value[nama_pegawai]</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>  

                        <button type="submit" class="mt-4 btn btn-primary">Simpan</button>
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
                <h4 class="modal-title" id="myModalLabel">Tambah Daerah Kunjungan</h4>
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
<div id="modalAddForkopimda" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_forkopimda" action="javascript:;" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Forkopimda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="nama_pegawai" required>
                </div>
                <div class="form-group">
                    <label for="">Prioritas</label>
                    <input type="text" class="form-control" name="priority" required>
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                    <select name="jk" id="jk" class="form-control select2" style="width:100%" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <input type="hidden" class="form-control" name="tipe" value="2">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect">Simpan</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/moment/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/ckeditor/ckeditor.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/ckeditor/samples/js/sample.js"></script>
<script>
$('.dateFormat').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
$(document).ready(function(){
    anggotaOption();
    forkopimdaOption();
    sekwanOption();

    $("#jenis").change(function(){
        var thisVal = $(this).val()
        var dataVal = $(this).find(':selected').data('val')
        if(dataVal=='Komisi' || dataVal=='Banggar' || dataVal=='Badan'){
            $("#mitra").show()
        }
        else{
            $("#mitra").hide()
        }

        $("#sub option").remove()
        var isSub = $(this).find(':selected').data('sub')
        if(isSub=='1'){
            $.ajax({
                type : 'get',
                data : {id_menu : thisVal},
                dataType : 'json',
                url : "<?= base_url('kunjungan/getSubMenu')?>",
                success : function(response){
                    $.each(response, function(key,data){
                        $("#sub").append(`<option data-val='${data.sub_menu}' value='${data.id_sub_menu}'>${data.sub_menu}</option>`)
                    })
                    $("#sub_jenis").show()
                }
            })
        }
        else{
            $("#sub_jenis").hide()
        }        
    })

    $("#sub").change(function(){
      var jenis = $("#jenis").val()  
      var sub = $(this).val()
      var dataJenis = $("#jenis").find(':selected').data('val')
      var dataSub = $(this).find(':selected').data('val')

      if(dataJenis=='Badan' && dataSub=='Bamperda' || dataJenis=='Badan' && dataSub=='Pansus' || dataJenis=='Komisi'){
          $("#mitra").show()
      }
      else{
          $("#mitra").hide()
      }
    })


    subOption();
    $("form#form_sub_tipe").on("submit", function( event ) {
        event.preventDefault();
        var response_data=null;
        $.ajax({
            type: "POST",
            url: "<?= base_url('kunjungan/add_sub_tipe')?>", //json get site
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
    sub_tipe.append('<option value="">Pilih Lokasi</option>')
    $.ajax({
        type: "get",
        url: "<?= base_url('kunjungan/sub_tipe')?>", //json get site
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

$("form#form_forkopimda").on("submit", function( event ) {
        event.preventDefault();
        var response_data=null;
        $.ajax({
            type: "POST",
            url: "<?= base_url('welcome/add_anggota')?>", //json get site
            dataType : 'json',
            data: $('#form_forkopimda').serialize(),
            success: function(response){
                response_data=response;
                forkopimdaOption();
            }
        });
        $('#modalAddForkopimda').modal('hide');
            
        });

function anggotaOption(){
    // var id_anggota=$('#id_anggota')
    // id_anggota.empty()
    // id_anggota.append('<option value="">Pilih Anggota Dewan</option>')
    $.ajax({
        type: "get",
        url: "<?= base_url('pegawai/anggota_json/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    var newOption = new Option(response_data[i]['nama_pegawai'],response_data[i]['id_pegawai'], false,false);
                    $("#row_anggota").append(newOption).trigger('change')
                 }
            }
        }
    });
}
function forkopimdaOption(){
    // var formkopimda_id=$('#formkopimda_id')
    // formkopimda_id.empty()
    // formkopimda_id.append('<option value="">Pilih Forkopimda</option>')
    $.ajax({
        type: "get",
        url: "<?= base_url('pegawai/anggota_json/2')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    var newOption = new Option(response_data[i]['nama_pegawai'],response_data[i]['id_pegawai'], false,false);
                    $("#row_forkopimda").append(newOption).trigger('change')
                 }
            }
        }
    });
}
function sekwanOption(){
    // var formkopimda_id=$('#formkopimda_id')
    // formkopimda_id.empty()
    // formkopimda_id.append('<option value="">Pilih Sekretaris Dewan</option>')
    $.ajax({
        type: "get",
        url: "<?= base_url('pegawai/anggota_json/3')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    var newOption = new Option(response_data[i]['nama_pegawai'],response_data[i]['id_pegawai'], false,false);
                    $("#row_sekwan").append(newOption).trigger('change')
                 }
            }
        }
    });
}
$('#waktu').datetimepicker({
    format: 'HH:mm',
    useCurrent: false,
    showTodayButton: true,
    showClear: true,
    toolbarPlacement: 'bottom',
    sideBySide: true,
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-clock-o",
        clear: "fa fa-trash-o"
    }    
});

</script>