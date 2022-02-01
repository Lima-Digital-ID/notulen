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
                            <input type="hidden" class="form-control" name="id_set_gaji" id="id_set_gaji" placeholder="Id Jabatan"  value="<?=$id_set_gaji?>" />
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Nama Pegawai <?php echo form_error('id_pegawai') ?>
                            </label>
                            <div class="col-lg-6">
                                <?php echo form_dropdown('id_pegawai',$pegawai_option,$id_pegawai,array('id'=>'id_pegawai','class'=>'form-control select2', 'required'=>'required', 'onchange'=>'cekPegawai()'));?>
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
                                Gaji Minimum <?php echo form_error('gaji_min') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="gaji_min" id="gaji_min" placeholder="Gaji Minimum" value="<?php echo $gaji_min; ?>" onkeyup="cekGajiMin(this)" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Denda owner/kasir (kosongi jika ingin memakai denda weekday & weekend) <?php echo form_error('denda') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="denda" id="denda" placeholder="Denda" value="<?php echo $denda; ?>" onkeyup="cekTj(this)"/>
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Denda Weekday (kosongi jika denda default) <?php echo form_error('denda_weekday') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="denda_weekday" id="denda_weekday" placeholder="Denda Weekday" value="<?php echo $denda_weekday; ?>" onkeyup="cekDwd(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Denda Weekend (kosongi jika denda default) <?php echo form_error('denda_weekend') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="denda_weekend" id="denda_weekend" placeholder="Denda Weekend" value="<?php echo $denda_weekend; ?>" onkeyup="cekDwe(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Bonus Kerajinan <?php echo form_error('bonus_kerajinan') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="bonus_kerajinan" id="bonus_kerajinan" placeholder="Bonus Kerajinan" value="<?php echo $bonus_kerajinan; ?>" onkeyup="cekBk(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Komisi Minimal Kepala <?php echo form_error('kom_min') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="kom_min" id="kom_min" placeholder="Komisi Minimal Kepala" value="<?php echo $kom_min; ?>" onkeyup="cekKM(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Komisi per Transaksi <?php echo form_error('kom_trx') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="kom_trx" id="kom_trx" placeholder="Komisi per Transaksi" value="<?php echo $kom_trx; ?>" onkeyup="cekKT(this)"/>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Komisi Bertingkat <?php echo form_error('kom_level') ?>
                            </label>
                            <div class="col-lg-6">
                               <input type="" class="form-control" name="kom_level" id="kom_level" placeholder="Komisi Bertingkat" value="<?php echo $kom_level; ?>" onkeyup="cekKL(this)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Tipe Gaji <?php echo form_error('tipe_gaji') ?>
                            </label>
                            <div class="col-lg-6">
                               <?php echo form_dropdown('tipe_gaji',array('1'=>1, '2'=>2, '3'=>3, '4'=>4),$tipe_gaji,array('id'=>'tipe_gaji','class'=>'form-control select2', 'required'=>'required'));?>
                               *ket : tipe gaji 1 = gaji pokok + komisi langsung, tipe gaji 2 = gaji pokok + komisi semua layanan, tipe gaji 3 = gaji pokok + komisi semua layanan selain potong + komisi minimal potong, tipe gaji 4 = gaji pokok + komisi per transaksi
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>