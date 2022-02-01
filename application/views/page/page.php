<!-- <div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            
        </div>
    </div>
</div>
 -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title text-center">Booking <?=$bl_name?></h4>
            <div class="row">
	            <div class="container px-lg-12">
				  <div class="row mx-lg-n5">
		            <?php 
		            foreach ($antrian as $key => $value) {
		            ?>
				    <div class="col px-lg-6" >
						<div class="card card-hover">
                            <div class="box <?= $value['contact_id'] != 0 ? 'bg-primary' : 'bg-success'?> text-center" style="padding : 20px">
                                <h3 class="font-light text-white"><?=$value['jam'] .' - '. $value['next']?></h3>
                                <!-- <span class="font-18 font-light text-white"><?=$value['jam'] .' - '. $value['next']?></span> -->
                                <h4 style="min-width:150px"><span class="label label-warning">Tersedia : <?=$value['sisa']?> kursi</span></h4>
                                <br>
                                <?php
                                
                                if ($value['contact_id'] != null) {
                                	if ($contact_id == $value['contact_id']) {
                                ?>
                                	<a <?=$value['is_close'] == 1 ? 'style="pointer-events: none; display: inline-block;" disabled' : ''?> href="<?=base_url('welcome/cancelAntrian/'.$value['id'])?>" class="btn waves-effect waves-light btn-rounded <?=$value['is_close'] != 1 ? ' btn-danger' : 'btn-outline-light'?>">Batal</a>
                                <?php
                                	}else{
                                ?>
                                    <p class="text-white">Mohon maaf kursi booking telah habis, silahkan datang  lngsung ke outlet, kami siap melayani selama jam buka sesuai dgn antrian</p>
                                	<!-- <span class="btn btn-rounded btn-outline-light">Dipesan</span> -->
                                <?php
                                	}
                                }else{
                                ?>
                                <form action="<?=base_url('welcome/saveAntrian')?>" method="post" hidden>
                                	<input type="hidden" name="time" value="<?=$value['jam']?>">
                                	<input type="hidden" name="contact_id" value="<?=$contact_id?>">
                                	<input type="hidden" name="bl_id" value="<?=$value['bl_id']?>">
						        <button <?=$value['is_close'] == 1 ? 'style="pointer-events: none; display: inline-block;" disabled' : ''?> class="btn waves-effect waves-light btn-rounded <?=$value['is_close'] != 1 ? ' btn-light' : 'btn-outline-light'?>">Ambil</button>
                                </form>
                                <button <?=$value['is_close'] == 1 ? 'style="pointer-events: none; display: inline-block;" disabled' : ''?> class="btn waves-effect waves-light btn-rounded <?=$value['is_close'] != 1 ? ' btn-light' : 'btn-outline-light'?>" type="button" data-jam="<?=$value['jam']?>" data-next="<?=$value['next']?>" data-sisa="<?=$value['sisa']?>" onclick="get_book(this)">
                                    Ambil
                                </button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
				    </div>
		            <?php
		            }
		            ?>
				  </div>
				</div>
            </div>
        </div>
    </div>
</div>
<div id="verticalcenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Anda akan mengambil booking jam</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div> -->
            <form action="<?=base_url('welcome/saveAntrian')?>" method="post" autocomplete="off">
            <div class="modal-body">
                <h5 class="modal-title" id="modal-title">Anda akan mengambil booking jam</h5>
                <br>
                <input type="hidden" name="time" id="time">
                <input type="hidden" name="contact_id" value="<?=$contact_id?>">
                <input type="hidden" name="bl_id" value="<?=$bl_id?>">
                <label>Jumlah Kursi yang di booking : </label>
                <input type="" class="form-control" min="1" required name="total_kursi" id="total_kursi" onkeyup="cekSisa(this.value)">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
                <button class="btn btn-info waves-effect">Ambil</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
var sisa=0;
function get_book(eq){
    var jam=$(eq).data('jam');
    var next=$(eq).data('next');
    sisa=$(eq).data('sisa');
    $('#time').val(jam);
    $('#modal-title').html('Anda akan mengambil booking jam '+jam+' - '+next+'?');
    $('#verticalcenter').modal('show');
}
function cekSisa(val){
    if(val > sisa){
        $('#total_kursi').val('');
        alert('inputan anda melebihi sisa kursi yang tersedia');
    }
}
</script>