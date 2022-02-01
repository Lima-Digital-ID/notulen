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
                        <input type="hidden" class="form-control" name="id" id="id" placeholder="Id"/>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Keterangan <?php echo form_error('ket') ?>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ket" id="ket" placeholder="Keterangan" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                Tanggal <?php echo form_error('tanggal') ?>
                            </label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Tanggal Mulai" required/>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="end_date" id="end_date" placeholder="Tanggal Berahir" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                            </label>
                            <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Create</button> 
                                    <a href="<?php echo site_url('hrms/cuti/holiday') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
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
    $( "#start_date" ).datepicker({
      dateFormat: "dd-mm-yy"
    });
    $( "#end_date" ).datepicker({
      dateFormat: "dd-mm-yy"
    });
</script>