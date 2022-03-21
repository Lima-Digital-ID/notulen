<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Rapat</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            
        </div>
    </div>
</div>
<?php
function getDay($date)
{
    $day=date('w', strtotime($date));
    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    return $days[$day];
}
function formatDate($date)
{
    $day=date('d-m-Y', strtotime($date));
    return $day;
}
function jenisRapat($tipe){
    if ($tipe == 1) {
        return 'Paripurna';
    }else if($tipe == 2){
        return 'Komisi';
    }else if($tipe == 3){
        return 'Bamus';
    }else if($tipe == 4){
        return 'Banggar';
    }else{
        return '';
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="mt-4" action="<?=base_url('rapat/save_tinjauan_rapat')?>" method="post" id="form_tinjau" autocomplete="off" enctype="multipart/form-data">
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td><?=$row_rapat->title?></td>
                                </tr>
                                <tr>
                                    <td>Hari</td>
                                    <td>:</td>
                                    <td><?=getDay($row_rapat->tanggal);?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><?=formatDate($row_rapat->tanggal)?></td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>:</td>
                                    <td><?=$row_rapat->waktu?> WIB</td>
                                </tr>
                                <tr>
                                    <td>Tempat</td>
                                    <td>:</td>
                                    <td><?=$row_rapat->tempat?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Rapat</td>
                                    <td>:</td>
                                    <td><?=tipe($row_rapat->tipe)?></td>
                                </tr>
                                <tr>
                                    <td>Sifat Rapat</td>
                                    <td>:</td>
                                    <td><?=$row_rapat->sifat == 1 ? 'Terbuka' : 'Tertutup'?></td>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        <input type="hidden" name="id" value="<?=$row_rapat->id?>">
                        <div class="form-group"  <?=$row_rapat->tipe != 1 ? 'hidden' : ''?>>
                            <label for="">Materi Rapat</label>
                            <textarea name="acara" cols="50" rows="15" class="mymce">
                                <?php if($row_rapat->acara != null){
                                    echo $row_rapat->acara;
                                }else{
                                ?>

                                <ol>
                                    <li>Pembukaan</li>
                                    <li>Pembacaan Berita Acara Hasil Penyusunan Propemperda Tahun 2020</li>
                                    <li>Penetapan Propemperda Tahun 2020</li>
                                    <li>Penyampaian Laporan Badan Anggaran hasil pembahasan atas Raperda tentang APBD TA 2020</li>
                                    <li>Penyampaian Pendapat Akhir Fraksi terhadap Raperda tentang APBD TA 2020</li>
                                    <li>Penyampaian Pendapat Akhir Walikota Blitar terhadap Raperda tentang APBD TA 2020</li>
                                    <li>Penetapan Persetujuan Bersama atas Raperda tentang APBD 2020</li>
                                    <li>Pembacaan Do&rsquo;a&nbsp;</li>
                                    <li>P e n u t u p</li>
                                </ol>
                                
                                <?php }?>
                            </textarea>
                        </div>          
                        <div class="form-group" <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                            <label for="">Dasar</label>
                            <textarea name="dasar" cols="50" rows="15" class="mymce">
                            <?=$row_rapat->dasar?>
                            </textarea>
                        </div>  
                        <div class="form-group" <?=$row_rapat->tipe != 1 ? 'hidden' : ''?>>
                            <label for="">Undangan</label>
                            <textarea name="undangan" cols="50" rows="15" class="mymce">
                            <?=$row_rapat->undangan?>
                            </textarea>
                        </div>  
                        <div class="form-group" <?=$row_rapat->tipe != 1 ? 'hidden' : ''?>>
                            <label for="">Isi Notulen</label>
                            <textarea name="isi_risalah" cols="50" rows="15" class="mymce">
                            <?=$row_rapat->isi_risalah?>
                            </textarea>
                        </div>  
                        <div class="form-group" <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                            <label for="">Hasil Kegiatan</label>
                            <textarea name="hasil_kegiatan" cols="50" rows="15" class="mymce">
                            <?=$row_rapat->hasil_kegiatan?>
                            </textarea>
                        </div>          
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Pimpinan Rapat</label>
                                    <select name="pimpinan" id="pimpinan" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                                <div class="form-group">
                                    <label for="">Wakil Ketua 1 Rapat</label>
                                    <select name="wakil_ketua1" id="wakil_ketua1" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                                <div class="form-group">
                                    <label for="">Wakil Ketua 2 Rapat</label>
                                    <select name="wakil_ketua2" id="wakil_ketua2" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                                <div class="form-group">
                                    <label for="">Sekretaris</label>
                                    <select name="sekretaris" id="sekretaris" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                        </div>   
<!--                         <div class="row">
                            <div class="col-md-5"><hr></div>
                            <div class="col-md-2">
                                <center style="margin-top:5px"><h5>Peserta Rapat</h5></center>
                            </div>
                            <div class="col-md-5"><hr></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Anggota DPRD</label>
                                <table style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Kehadiran</td>
                                            <td>Keterangan</td>
                                            <td <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>Jabatan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($anggota_rapat as $row){
                                            if($row->tipe == 1){
                                        ?>
                                        <tr>
                                            <td><input type="hidden" value="<?=$row->id?>" name="id_detail[]"><?=$row->nama_pegawai?></td>
                                            <td>
                                            <input type="checkbox" value="<?=$row->id?>" <?=$row->status == 1 ? 'checked' : ''?> name="check_id[]">
                                            </td>
                                            <td>
                                            <input type="text" name="keterangan[]" value="<?=$row->keterangan?>">
                                            </td>
                                            <td <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                                            <input type="text" name="jabatan[]" value="<?=$row->jabatan?>">
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Mitra Kerja</label>
                                <table style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Kehadiran</td>
                                            <td>Keterangan</td>
                                            <td <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>Jabatan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($anggota_rapat as $row){
                                            if($row->tipe == 2){
                                        ?>
                                        <tr>
                                            <td><input type="hidden" value="<?=$row->id?>" name="id_detail[]"><?=$row->nama_pegawai?></td>
                                            <td>
                                            <input type="checkbox" value="<?=$row->id?>" <?=$row->status == 1 ? 'checked' : ''?> name="check_id[]">
                                            </td>
                                            <td>
                                            <input type="text" name="keterangan[]" value="<?=$row->keterangan?>">
                                            </td>
                                            <td <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                                            <input type="text" name="jabatan[]" value="<?=$row->jabatan?>">
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Sekretaris Dewan</label>
                                <table style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Kehadiran</td>
                                            <td>Keterangan</td>
                                            <td <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>Jabatan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($anggota_rapat as $row){
                                            if($row->tipe == 3){
                                        ?>
                                        <tr>
                                            <td><input type="hidden" value="<?=$row->id?>" name="id_detail[]"><?=$row->nama_pegawai?></td>
                                            <td>
                                            <input type="checkbox" value="<?=$row->id?>" <?=$row->status == 1 ? 'checked' : ''?> name="check_id[]">
                                            </td>
                                            <td>
                                            <input type="text" name="keterangan[]" value="<?=$row->keterangan?>">
                                            </td>
                                            <td <?=$row_rapat->tipe == 1 ? 'hidden' : ''?>>
                                            <input type="text" name="jabatan[]" value="<?=$row->jabatan?>">
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
 -->                        <br><br>
                        <div class="form-group">
                            <label for="">Galeri Rapat</label>
                            <input type="file" class="form-control" name="files[]" id="files" multiple=""  accept="application/pdf,application/vnd.ms-excel,image/*">
                        </div>  
                        <div class="row el-element-overlay" id="data-galery">
                            
                        </div>        
                        <br><br>
                        <input type="hidden" name="is_edit" id="is_edit">
                        <button type="button" onClick="save(1)" class="btn btn-info">Simpan Sementara</button>
                        <button type="button" onClick="save(0)" class="btn btn-primary">Simpan Final</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/moment/moment.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/ckeditor/ckeditor.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/tinymce/tinymce.min.js"></script>
<!-- <script src="<?=base_url('assets/')?>theme/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url('assets/')?>theme/assets/libs/magnific-popup/meg.init.js"></script> -->
<script>
$('#tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
$(document).ready(function(){
    pimpinanOption()
    wakilKetua1Option()
    wakilKetua2Option()
    sekretarisOption()
    showGalery();
    $(document).ready(function() {
        if ($(".mymce").length > 0) {
            tinymce.init({
                selector: "textarea.mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
});
function pimpinanOption(){
    var pimpinan=$('#pimpinan')
    pimpinan.empty()
    pimpinan.append('<option value="">Pilih Pimpinan Rapat</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('rapat/anggota_rapat/'.$row_rapat->id.'/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    pimpinan.append('<option '+(<?=$row_rapat->pimpinan != null ? $row_rapat->pimpinan : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
function wakilKetua1Option(){
    var wakilKetua1=$('#wakil_ketua1')
    wakilKetua1.empty()
    wakilKetua1.append('<option value="">Pilih Wakil Ketua 1 Rapat</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('rapat/anggota_rapat/'.$row_rapat->id.'/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    wakilKetua1.append('<option '+(<?=$row_rapat->wakil_ketua1 != null ? $row_rapat->wakil_ketua1 : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
function wakilKetua2Option(){
    var wakilKetua2=$('#wakil_ketua2')
    wakilKetua2.empty()
    wakilKetua2.append('<option value="">Pilih Wakil Ketua 2 Rapat</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('rapat/anggota_rapat/'.$row_rapat->id.'/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    wakilKetua2.append('<option '+(<?=$row_rapat->wakil_ketua2 != null ? $row_rapat->wakil_ketua2 : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
function sekretarisOption(){
    var sekretaris=$('#sekretaris')
    sekretaris.empty()
    sekretaris.append('<option value="">Pilih Sekretaris</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('rapat/anggota_rapat/'.$row_rapat->id.'/2')?>", //json get site
        dataType : 'json',
        success: function(response){
            console.log(response)
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    sekretaris.append('<option '+(<?=$row_rapat->sekretaris != null ? $row_rapat->sekretaris : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
function showGalery(){
    var data_galery=[];
    $('#data-galery').empty()
    $.ajax({
        type: "get",
        url: "<?= base_url('rapat/get_galery/'.$row_rapat->id)?>", //json get site
        dataType : 'json',
        async : false,
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    var body='<div class="col-sm-6 col-lg-2">'+
                                '<div class="card">'+
                                    '<div class="el-card-item">'+
                                        '<div class="el-card-avatar el-overlay-1"> <img src="<?=base_url()?>/assets/images/bukti_rapat/'+response_data[i]['file']+'" alt="'+response_data[i]['file']+'" width="120px"/>'+
                                            '<div class="el-overlay">'+
                                                '<ul class="list-style-none el-info">'+
                                                    '<li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);" data-id="'+response_data[i]['id']+'" onclick="deleteGalery(this)"><i class="fa fa-trash"></i></a></li>'+
                                                    '<li class="el-item"><a class="btn default btn-outline el-link" href="<?=base_url()?>/assets/images/bukti_rapat/'+response_data[i]['file']+'" target="_blank" data-id="'+response_data[i]['id']+'" title="lihat file"><i class="fa fa-eye"></i></a></li>'+
                                                '</ul>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    $('#data-galery').append(body)
                }
            }
        }
    });

}
function deleteGalery(eq){
    var id=$(eq).data('id')
    if (confirm("Apakah anda akan menghapus gambar ini ?")) {
        $.ajax({
            type: "get",
            url: "<?= base_url('rapat/delete_galery')?>"+'/'+id, //json get site
            dataType : 'json',
            success: function(response){
                showGalery()
            }
        });
        
    } else {
    }
}
function save(val){
    $('#is_edit').val(val)
    $('#form_tinjau').submit()
}
</script>