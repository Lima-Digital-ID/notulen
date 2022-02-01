<section role="main" class="content-body pb-0">
    <header class="page-header">
        <h2><?=$title?></h2>
    
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?=base_url('welcome')?>">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span><?=$title?></span></li>
            </ol>
            <a style="margin-left:10px"></a>
            <!-- <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a> -->
        </div>
    </header>
    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured mb-4">
                <div class="card-header">
                    <h4><?=$title?></h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" action="<?php echo $action; ?>" method="post">
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id_ref_gaji" id="id_ref_gaji" placeholder="Id Jabatan" value="<?php echo $id_ref_gaji; ?>" />
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Nama Jabatan <?php echo form_error('id_jabatan') ?>
                            </label>
                            <div class="col-lg-6">
                                <?php echo form_dropdown('id_jabatan',$jabatan_option,$id_jabatan,array('id'=>'id_jabatan','class'=>'form-control select2', 'required'=>'required'));?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Gaji Pokok <?php echo form_error('gaji_pokok') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="gaji_pokok" id="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $gaji_pokok; ?>" onkeyup="cekGaji(this)" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Uang Kehadiran <?php echo form_error('uang_kehadiran') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="" class="form-control" name="uang_kehadiran" id="uang_kehadiran" placeholder="Uang Kehadiran" value="<?php echo $uang_kehadiran; ?>" onkeyup="cekUK(this)" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Uang Makan <?php echo form_error('uang_makan') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="uang_makan" id="uang_makan" placeholder="Uang Makan" value="<?php echo $uang_makan; ?>" onkeyup="cekUM(this)" onkeyup="cekUM(this)" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Uang Transport <?php echo form_error('uang_transport') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="uang_transport" id="uang_transport" placeholder="Uang Transport" value="<?php echo $uang_transport; ?>" onkeyup="cekUT(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Uang Lembur <?php echo form_error('uang_lembur') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="uang_lembur" id="uang_lembur" placeholder="Uang Lembur" value="<?php echo $uang_lembur; ?>" onkeyup="cekUL(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('hrms/ref_gaji') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>