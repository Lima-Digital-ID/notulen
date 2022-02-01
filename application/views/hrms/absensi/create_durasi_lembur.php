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
                    <form class="form-horizontal form-bordered" action="<?php echo $action; ?>" method="post" autocomplete="off">
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id_set_gaji" id="id_set_gaji" placeholder="Id Jabatan"  value="" />
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Tanggal
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="tanggal" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Pegawai
                            </label>
                            <div class="col-lg-6">
                               <?php echo form_dropdown('id_pegawai',$pegawai_option,'',array('id'=>'id_pegawai','data-plugin-selectTwo'=>'','class'=>'form-control select2', 'required'=>'required'));?>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Durasi Lembur
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" name="durasi" id="durasi" placeholder="Durasi" required/>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Uang Lembur
                            </label>
                            <div class="col-lg-6">
                                <input type="" class="form-control" name="uang_lembur" id="uang_lembur" placeholder="Uang Lembur" required onkeyup="formatUL(this)"/>
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( "#tanggal" ).datepicker({
      dateFormat: "dd-mm-yy"
    });
</script>