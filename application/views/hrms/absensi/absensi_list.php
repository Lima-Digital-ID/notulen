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
                <div class="card-body">
                    <div class="form-inline">
                        <?php //echo anchor(site_url('hrms/absensi/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-info btn-sm"'); ?>
                        <?php //echo anchor(site_url('hrms/absensi/cuti'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah Cuti', 'class="btn btn-warning btn-sm"'); ?>
                        <!-- &nbsp; -->
                        <?php echo anchor(site_url('hrms/absensi/month'), '<i class="fab fa-wpforms" aria-hidden="true"></i> Log Absensi per Bulan', 'class="btn btn-primary btn-sm"'); ?>
                        &nbsp;
                        <?php echo anchor(site_url('hrms/absensi/lembur'), '<i class="fa fa-clock" aria-hidden="true"></i> Tambah Uang Lembur', 'class="btn btn-primary btn-sm"'); ?>
                        &nbsp;
                        <?php echo anchor(site_url('hrms/absensi/import_excel'), '<i class="fa fa-upload" aria-hidden="true"></i> Import Absensi', 'class="btn btn-success btn-sm"'); ?>
                        &nbsp;
                        <label style="padding-left:20px">Lihat Tanggal : </label>
                        &nbsp;
                        <input type="text" id="date" class="form-control" >
                        &nbsp;
                        <button class="btn btn-primary"  onclick="cekAbsensiDate()"><i class="fa fa-search"></i></button>
                    </div>
                <!-- </div>
                <div class="card-body"> -->
                    <hr>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
                                <th>Jam Datang</th>
                                <th>Jam Pulang</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                    
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( "#date" ).datepicker({
      dateFormat: "dd-mm-yy"
    });
</script>