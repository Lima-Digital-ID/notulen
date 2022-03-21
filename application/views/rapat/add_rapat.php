<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Rapat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                    <h4 class="card-title">Tambah</h4>
                    <form class="mt-4" action="<?=base_url('rapat/save_rapat')?>" method="post" id="form_add" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group" id="nomorRapat">
                            <label for="">Nomor Rapat</label>
                            <input type="text" name="nomor"  class="form-control">
                            <input type="hidden" name="nomor_auto"  class="form-control" value="<?= $nomor ?>">
                        </div>           

                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required autofocus>
                        </div>   
                        <div class="form-group">
                            <label>Tempat</label>
                            <input type="text" class="form-control" name="tempat">
                        </div>   
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control tanggal" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" >
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="text" id="waktu" class="waktu form-control" name="waktu" >
                                </div>   
                            </div>
                        </div>          
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="text" class="form-control tanggal" id="tanggalSelesai" name="tanggal_selesai" placeholder="dd/mm/yyyy" >
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu Selesai</label>
                                    <input type="text" id="waktuSelesai" class="waktu form-control" name="waktu_selesai" >
                                </div>   
                            </div>
                        </div>          
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Sifat Rapat</label>
                                    <select name="sifat" id="sifat" class="form-control select2" style="width:100%">
                                        <option value="0">Tertutup</option>
                                        <option value="1">Terbuka</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Jenis Rapat</label>
                                    <select name="tipe" id="tipe" class="form-control select2" style="width:100%" required>
                                    <option data-val="" data-sub="0" value="">---Pilih Jenis---</option>
                                    <?php 
                                            foreach ($menuRapat as $value) {
                                    ?>
                                    <option data-val="<?= $value['menu'] ?>" data-sub="<?= $value['is_sub'] ?>" value="<?php echo $value['id_menu'] ?>"><?php echo $value['menu'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" id="submenu_komisi" style="display:none">
                                <div class="form-group">
                                    <label for="">Sub Menu Rapat Komisi</label>
                                    <select name="sub_menu_komisi" id="sub" class="form-control select2" style="width:100%;">
                                        <option value="0" selected>--Pilih--</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>             
                        <!-- <div class="form-group" id="nomorRapat">
                            <label for="">Lampiran</label>
                            <textarea name="lampiran" id="ckeditor" cols="50" rows="15" class="ckeditor"></textarea>
                        </div>            -->

                        <div class="row">
                        <div class="col-md-5"><hr></div><div class="col-md-2"><center style="margin-top:5px"><h5>Peserta Rapat</h5></center></div><div class="col-md-5"><hr></div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <div class="col-6">
                           
                                <label for="">Anggota DPRD</label>
                                <select name="id_anggota[]" multiple id="row_anggota" style="width:100%" class="select2 form-control"></select>
                                
                                <div id="sekwan">
                                <label for="" class="mt-3">Sekretaris Dewan</label>
                                <select name="id_anggota[]" id="row_sekwan" style="width:100%" class="select2 form-control" multiple="multiple"></select>
                                </div>
                            </div>
                            
                            <div class="col-6" id="mitra">
                                <label for="">Mitra Kerja</label>
                                <select name="id_anggota[]" multiple id="row_forkopimda" style="width:100%" class="select2 form-control"></select>
                           
                            </div>
                        </div>  
                        <br><br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
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
$('.tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
$(document).ready(function(){
    anggotaOption();
    forkopimdaOption();
    sekwanOption();
    $("#tipe").change(function(){
        var thisVal = $(this).val()
        var dataVal = $(this).find(':selected').data('val')

        if(thisVal=='1'){ //if paripurna, hide sekwan
            $("#sekwan").hide()
            $("#nomorRapat").hide()
        }
        else{
            $("#nomorRapat").show()
            $("#sekwan").show()
        }

        $("#submenu_komisi option").remove()
        var isSub = $(this).find(':selected').data('sub')
        if(isSub=='1'){
            $.ajax({
                type : 'get',
                data : {id_menu : thisVal},
                dataType : 'json',
                url : "<?= base_url('rapat/getSubMenu')?>",
                success : function(response){
                    $.each(response, function(key,data){
                        $("#sub").append(`<option data-val='${data.sub_menu}' value='${data.id_sub_menu}'>${data.sub_menu}</option>`)
                    })
                    $("#submenu_komisi").show()
                }
            })
        }
        else{
            $("#submenu_komisi").hide()
        }        
    })
    $("#sub").change(function(){
      var tipe = $("#tipe").val()
      var sub = $(this).val()
      var dataTipe = $("#tipe").find(':selected').data('val')
      var dataSub = $(this).find(':selected').data('val')
    })
    <?php 
        if(isset($_GET['tipe'])){
    ?>
    $("#tipe").val('<?= $_GET['tipe'] ?>').trigger('change')
    <?php } ?>
    <?php 
        if(isset($_GET['sub'])){
    ?>
    $("#sub").val('<?= $_GET['sub'] ?>').trigger('change')
    <?php } ?>
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

/*                 for(i=0; i < response_data.length; i++){
                    // id_anggota.append('<option value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                    $('#row_anggota').append('<tr><th class="text-center"width="10px"><input type="checkbox" value="'+response_data[i]['id_pegawai']+'" name="id_anggota[]"  id="'+response_data[i]['id_pegawai']+'"></th> <th class="text-center" width="300px"><label class="form-check-label" for="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</label></th></tr>')
                }
 */            }
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
$('.waktu').datetimepicker({
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