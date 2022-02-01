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
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                ID SHIFT <?php echo form_error('id_SHIFT') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="id_shift" id="id_shift" placeholder="ID SHIFT Auto Number" readonly="true" value="<?php echo $id_shift; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Nama SHIFT <?php echo form_error('nama_SHIFT') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="text" class="form-control" name="nama_shift" id="nama_shift" placeholder="Nama SHIFT" value="<?php echo $nama_shift; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Jam Datang <?php echo form_error('jam_datang') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="jam_datang" id="jam_datang" placeholder="Jam Datang" value="<?php echo $jam_datang; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Jam Pulang <?php echo form_error('jam_pulang') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="jam_pulang" id="jam_pulang" placeholder="Jam Pulang" value="<?php echo $jam_pulang; ?>">
                                <!-- <input type="time" class="form-control"  /> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('hrms/shift') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>