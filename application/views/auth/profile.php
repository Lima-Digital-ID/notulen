<section role="main" class="content-body pb-0">
	<header class="page-header">
		<h2>Layouts</h2>
	
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?=base_url('welcome')?>">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span>Profile</span></li>
			</ol>
			<a style="margin-left:10px"></a>
			<!-- <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a> -->
		</div>
	</header>
	<div class="row" style="margin-bottom:20px">
		<div class="col">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<!-- <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
						<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a> -->
					</div>
					<h2 class="card-title">Profil Admin</h2>
				</header>
				<div class="card-body">
					<form class="form-horizontal form-bordered" action="<?=current_url()?>" method="post">
						<?=form_input(array('name'=>'adm_id', 'value' => $data->adm_id, 'class'=>'form-control', 'type'=>'hidden', 'placeholder'=>'nama'))?>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2">Nama <?php echo form_error('adm_nama') ?></label>
							<div class="col-lg-6">
								<?=form_input(array('name'=>'adm_nama', 'value' => $data->adm_nama, 'class'=>'form-control', 'type'=>'text', 'placeholder'=>'nama'))?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2">Username <?php echo form_error('adm_username') ?></label>
							<div class="col-lg-6">
								<?=form_input(array('name'=>'adm_username', 'value' => $data->adm_username, 'class'=>'form-control', 'type'=>'text', 'placeholder'=>'nama'))?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2">No Hp/Telepon <?php echo form_error('adm_telp') ?></label>
							<div class="col-lg-6">
								<?=form_input(array('name'=>'adm_telp', 'value' => $data->adm_telp, 'class'=>'form-control', 'type'=>'text', 'placeholder'=>'nama'))?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2">Role <?php echo form_error('adm_role') ?></label>
							<div class="col-lg-6">
								<?=form_input(array('name'=>'adm_role', 'value' => $data->adm_role, 'class'=>'form-control', 'type'=>'text', 'placeholder'=>'nama'))?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 control-label text-lg-right pt-2">Status <?php echo form_error('adm_status') ?></label>
							<div class="col-lg-6">
								<?=form_input(array('name'=>'adm_status', 'value' => $data->adm_status, 'class'=>'form-control', 'type'=>'text', 'placeholder'=>'nama'))?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-3">
								
							</div>
							<div class="col-lg-6">
								<button type="submit" name="submit" class="btn btn-success">Simpan</button>
								<a class="modal-with-zoom-anim ws-normal btn btn-info" href="#changePassModal">Ubah Password</a>
							</div>
						</div>						
					</form>
				</div>
			</section>
		</div>
	</div>
</section>
		
<div id="changePassModal" class="zoom-anim-dialog modal-block modal-block-info mfp-hide">
	<section class="card">
		<form action="<?=base_url('user/changePassword')?>" method="post">
		<header class="card-header">
			<h2 class="card-title">Ubah Password</h2>
		</header>
		<div class="card-body">
			<div class="modal-wrapper">
					<?=form_input(array('name'=>'id', 'value' => $data->adm_id, 'class'=>'form-control', 'type'=>'hidden', 'placeholder'=>'nama'))?>
					<?=form_input(array('name'=>'password','class'=>'form-control', 'type'=>'password', 'placeholder'=>'Password Baru', 'required'=>''))?>
			</div>
		</div>
		<footer class="card-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-success" type="submit">Simpan</button>
					<button class="btn btn-danger modal-dismiss">Batal</button>
				</div>
			</div>
		</footer>
		</form>
	</section>
</div>