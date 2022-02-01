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
        </div>
    </header>
    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured mb-4">
                <div class="card-body">
                    <div style="padding-bottom: 10px;">
                    <?php echo anchor(site_url('hrms/shift/create'), '<i class="fab fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-info btn-sm"'); ?>
                    </div>
                    <table class="table table-bordered table-striped" id="shift_list">
                        <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th>Nama Shift</th>
                                <th>Jam Datang</th>
                                <th>Jam Pulang</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                    
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>