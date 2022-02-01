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
function tipeKunjungan($tipe){
    if ($tipe == 1) {
        return 'Kunker';
    }else if($tipe == 2){
        return 'Hearing';
    }else if($tipe == 3){
        return 'Sidak';
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
                    <form class="mt-4" action="<?=base_url('kunjungan/save_tinjauan')?>" method="post" id="form_tinjau" autocomplete="off" enctype="multipart/form-data">
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td><?=$row_kunjungan->nama?></td>
                                </tr>
                                <tr>
                                    <td>Hari</td>
                                    <td>:</td>
                                    <td><?=getDay($row_kunjungan->awal_waktu_pelaksanaan);?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><?=formatDate($row_kunjungan->awal_waktu_pelaksanaan)?></td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>:</td>
                                    <td><?=$row_kunjungan->waktu?> WIB</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kunjungan</td>
                                    <td>:</td>
                                    <td><?=tipe($row_kunjungan->jenis_kunjungan)?></td>
                                </tr>
                                <tr>
                                    <td>Kunjungan ke</td>
                                    <td>:</td>
                                    <td><?=$sub_tipe->nama?></td>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        <input type="hidden" name="id" value="<?=$row_kunjungan->id?>">
                        <div class="form-group">
                            <label for="">Dasar</label>
                            <textarea name="dasar" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->dasar?>
                            </textarea>
                        </div>  
                        <div class="form-group" >
                            <label for="">Maksud dan Tujuan</label>
                            <textarea name="tujuan" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->tujuan?>
                            </textarea>
                        </div> 
                        <div class="form-group" >
                            <label for="">Undangan</label>
                            <textarea name="undangan" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->undangan?>
                            </textarea>
                        </div>  
                        <div class="form-group">
                            <label for="">Kesimpulan</label>
                            <textarea name="kesimpulan" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->kesimpulan?>
                            </textarea>
                        </div>      
                        <div class="form-group">
                            <label for="">Penutup</label>
                            <textarea name="penutup" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->penutup?>
                            </textarea>
                        </div> 
                        <div class="form-group"  >
                            <label for="">Materi</label>
                            <textarea name="materi" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->materi?>
                            </textarea>
                        </div>  
                        <div class="form-group">
                            <label for="">Hasil</label>
                            <textarea name="hasil" cols="50" rows="15" class="mymce">
                            <?=$row_kunjungan->hasil?>
                            </textarea>
                        </div> 
                        <div class="form-group">
                            <label for="">Saran Tindakan</label>
                            <textarea name="saran" class="mymce">
                            <?=$row_kunjungan->saran?>
                            </textarea>
                        </div>           
                        <div class="form-group">
                            <label for="">Lain-lain</label>
                            <textarea name="lain" class="mymce">
                            <?=$row_kunjungan->lain?>
                            </textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Nama Pelapor</label>
                            <input type="text" name="pelapor" class="form-control" value="<?= $row_kunjungan->pelapor ?>"/>
                        </div>
<!--                         <div class="form-group">
                            <label for="">List Anggota Dewan</label>&nbsp;<a href="<?= base_url() . "Kunjungan/addDetailnama" ?>" class="btn btn-primary btn-xs addDetail" style="margin-top:5px"><i class="fa fa-plus"></i></a><br>
                            <label for="">Tambah Anggota</label>&nbsp;<a href="<?= base_url() . "Kunjungan/addDetailnama2" ?>" class="btn btn-primary btn-xs addDetail" style="margin-top:5px"><i class="fa fa-plus"></i></a>
                            <div class="loop-detail" data-counting='1'>
                            <?php
     //                       $this->load->view('kunjungan/loop-detail', ['start' => 1, 'now' => 1, 'tipe' => 1])
                             ?>
                            </div>
                        </div>
 -->              
 <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Pimpinan Rapat</label>
                                    <select name="pimpinan" id="pimpinan" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Wakil Ketua 1 Rapat</label>
                                    <select name="wakil_ketua1" id="wakil_ketua1" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Wakil Ketua 2 Rapat</label>
                                    <select name="wakil_ketua2" id="wakil_ketua2" class="form-control select2" style="width:100%">
                                    
                                    </select>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="form-group">
                            <label for="">Galeri Rapat</label>
                            <input type="file" class="form-control" name="files[]" id="files" multiple=""  accept="application/pdf,application/vnd.ms-excel,image/*">
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
function removeField(thisParam){
		var target = thisParam.data("target");
		var counting = parseInt($(".loop-detail").attr("data-counting"));
		counting--;
		$(".loop-detail").attr("data-counting", counting);
		$(".detail-field[data-id='" + target + "']").remove();
	}
	$(".removeField").click(function (e) {
		e.preventDefault();
		removeField($(this))
	});

	$(".addDetail").click(function (e) {
		e.preventDefault();
		var url = $(this).attr("href");
		var counting = parseInt($(".loop-detail").attr("data-counting"));
		counting++;

		$.ajax({
			url: url,
			method: "get",
			data: { counting: counting },
			success: function (data) {
				$(".loop-detail").append(data);
				$(".loop-detail").attr("data-counting", counting);
				$(".removeField").click(function (e) {
					e.preventDefault();
					removeField($(this))
				});
				
			},
		});
	});
</script>
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
    pimpinan.append('<option value="">Pilih Pimpinan Kunjungan</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('kunjungan/anggota_kunjungan/'.$row_kunjungan->id.'/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    pimpinan.append('<option '+(<?=$row_kunjungan->pimpinan != null ? $row_kunjungan->pimpinan : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
function wakilKetua1Option(){
    var wakilKetua1=$('#wakil_ketua1')
    wakilKetua1.empty()
    wakilKetua1.append('<option value="">Pilih Wakil Ketua 1 Kunjungan</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('kunjungan/anggota_kunjungan/'.$row_kunjungan->id.'/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    wakilKetua1.append('<option '+(<?=$row_kunjungan->wakil_ketua1 != null ? $row_kunjungan->wakil_ketua1 : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
                }
            }
        }
    });
}
function wakilKetua2Option(){
    var wakilKetua2=$('#wakil_ketua2')
    wakilKetua2.empty()
    wakilKetua2.append('<option value="">Pilih Wakil Ketua 2 Kunjungan</option>')

    $.ajax({
        type: "get",
        url: "<?= base_url('kunjungan/anggota_kunjungan/'.$row_kunjungan->id.'/1')?>", //json get site
        dataType : 'json',
        success: function(response){
            response_data=response['data'];
            if(response_data != null){
                for(i=0; i < response_data.length; i++){
                    wakilKetua2.append('<option '+(<?=$row_kunjungan->wakil_ketua2 != null ? $row_kunjungan->wakil_ketua2 : 0?> == response_data[i]['id_pegawai'] ? 'selected' : '')+' value="'+response_data[i]['id_pegawai']+'">'+response_data[i]['nama_pegawai']+'</option>')
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
        url: "<?= base_url('rapat/get_galery/'.$row_kunjungan->id)?>", //json get site
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