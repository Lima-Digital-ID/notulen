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
                        <input type="hidden" class="form-control" name="id_absensi" id="id_absensi" placeholder="Id Jabatan" value="<?php echo $id_absensi; ?>" />
                        <input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" placeholder="Id Jabatan" value="<?php echo $id_pegawai; ?>" />
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Nama Pegawai <?php echo form_error('nama_pegawai') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai"  value="<?php echo $nama_pegawai; ?>" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Tanggal <?php echo form_error('tanggal') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" name="tanggal" id="tanggal"  value="<?php echo $tanggal; ?>" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Jam Datang <?php echo form_error('jam_datang') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="jam_datang" id="jam_datang"  value="<?php echo $jam_datang; ?>" required>
                                <!-- <input type="time" class="form-control" /> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Jam Pulang <?php echo form_error('jam_pulang') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="jam_pulang" id="jam_pulang"  value="<?php echo $jam_pulang; ?>" required/>
                                <!-- <input type="time" class="form-control" name="jam_pulang" id="jam_pulang"  value="<?php echo $jam_pulang; ?>" required/> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Keterangan <?php echo form_error('ket') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ket" id="ket"  value="<?php echo $ket; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Uang Lembur
                            </label>
                            <div class="col-lg-6">
                                <input type="" class="form-control" name="uang_lembur" id="uang_lembur" placeholder="Uang Lembur" required onkeyup="formatUL(this)" value="<?php echo $uang_lembur; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                <a href="<?php echo $_SERVER['HTTP_REFERER']?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>