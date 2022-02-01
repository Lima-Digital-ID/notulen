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
                    <form class="mt-4" action="<?=base_url('rapat/update')?>" method="post" id="form_add" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="id_rapat" value="<?= $rapat->id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $rapat->title ?>" required autofocus>
                        </div>   
                        <div class="form-group">
                            <label>Tempat</label>
                            <input type="text" value="<?= $rapat->tempat ?>" class="form-control" name="tempat">
                        </div>   
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" value="<?= $rapat->tanggal ?>" >
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="text" id="waktu" class="form-control" value="<?= $rapat->waktu ?>" name="waktu" >
                                </div>   
                            </div>
                        </div>          
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Sifat Rapat</label>
                                    <select name="sifat" id="sifat" class="form-control select2" style="width:100%">
                                        <option value="0" <?= $rapat->sifat=='0' ? 'selected' : '' ?>>Tertutup</option>
                                        <option value="1" <?= $rapat->sifat=='1' ? 'selected' : '' ?>>Terbuka</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Jenis Rapat</label>
                                    <select name="tipe" id="tipe" class="form-control select2" style="width:100%">
                                    <option data-val="" data-sub="0" value="0">---Pilih Jenis---</option>
                                    <?php 
                                            foreach ($menuRapat as $value) {
                                    ?>
                                    <option data-val="<?= $value['menu'] ?>" data-sub="<?= $value['is_sub'] ?>" value="<?php echo $value['id_menu'] ?>" <?= $rapat->tipe==$value['id_menu'] ? 'selected' : '' ?>><?php echo $value['menu'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" id="submenu_komisi">
                                <div class="form-group">
                                    <label for="">Sub Menu Rapat Komisi</label>
                                    <select name="sub_menu_komisi" id="sub" class="form-control select2" style="width:100%;">
                                        <option value="0" selected>--Pilih--</option>
                                        <?php 
                                            foreach ($subMenu as $value) {
                                            ?>
                                                <option data-val='<?= $value['sub_menu'] ?>' value="<?= $value['id_sub_menu'] ?>" <?= $rapat->sub_tipe_komisi==$value['id_sub_menu'] ? 'selected' : '' ?>><?= $value['sub_menu'] ?></option>
                                            <?php
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>             
                        <div class="form-group" id="nomorRapat">
                            <label for="">Nomor Rapat</label>
                            <input type="text" name="event" value="<?= $rapat->event ?>"  class="form-control">
                        </div>           
                        <div class="form-group" id="nomorRapat">
                            <label for="">Lampiran</label>
                            <textarea name="lampiran" id="ckeditor" cols="50" rows="15" class="ckeditor">
                            <?= $rapat->lampiran ?>                            
                            </textarea>
                        </div>           

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
                                <select name="sekretaris" id="row_sekwan" style="width:100%" class="select2 form-control"></select>
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
$('#tanggal').datepicker({
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
                $.ajax({
                    type: "get",
                    url: "<?= base_url('pegawai/anggota_json_by_rapat?id_rapat='.$rapat->id.'&tipe_pegawai=1')?>", //json get site
                    dataType : 'json',
                    success : function(data){
                        data = data['data']
                        var arr = []
                        for(i=0; i < data.length; i++){
                            arr.push(data[i]['id_pegawai']);
                        }
                        $("#row_anggota").val(arr).trigger('change')
                    }

                })
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
                 $.ajax({
                    type: "get",
                    url: "<?= base_url('pegawai/anggota_json_by_rapat?id_rapat='.$rapat->id.'&tipe_pegawai=2')?>", //json get site
                    dataType : 'json',
                    success : function(data){
                        data = data['data']
                        var arr = []
                        for(i=0; i < data.length; i++){
                            arr.push(data[i]['id_pegawai']);
                        }
                        $("#row_forkopimda").val(arr).trigger('change')
                    }

                })


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
                 $.ajax({
                    type: "get",
                    url: "<?= base_url('pegawai/anggota_json_by_rapat?id_rapat='.$rapat->id.'&tipe_pegawai=3')?>", //json get site
                    dataType : 'json',
                    success : function(data){
                        data = data['data']
                        var arr = []
                        for(i=0; i < data.length; i++){
                            arr.push(data[i]['id_pegawai']);
                        }
                        $("#row_sekwan").val(arr).trigger('change')
                    }

                })

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