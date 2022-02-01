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
                        <div class="form-group row" hidden>
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                ID <?php echo form_error('id') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="id" id="id" placeholder="ID Pegawai Auto Number" readonly="true" value="<?php echo $id; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                               Jam Datang <?php echo form_error('jam_datang') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="jam_datang" id="jam_datang"  value="<?php echo $jam_datang; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Jam Pulang <?php echo form_error('jam_pulang') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="jam_pulang" id="jam_pulang"  value="<?php echo $jam_pulang; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Lokasi 
                            </label>
                            <div class="col-lg-6">
                                <?php echo cmb_dinamis('location_id', 'business_locations', 'name', 'id', $location_id) ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                    <a href="<?php echo site_url('hrms/pegawai') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>