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
        <?php 
            if($this->session->flashdata('message_type') == 'success')
                echo alert('alert-success', 'Sukses', $this->session->flashdata('message')); 
        ?>
        </div>
        <div class="col-md-12">
        <?php 
            if($this->session->flashdata('message_type') == 'danger')
                echo alert('alert-danger', 'Gagal', $this->session->flashdata('message'));
        ?>
        </div>
        <div class="col-md-12">
            <section class="card card-featured mb-4">
                <div class="card-body">
                    <div style="padding-bottom: 10px;">
                        <?php echo anchor(site_url('hrms/set_gaji/create'), '<i class="fab fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-info btn-sm"'); ?>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="set_gaji_list">
                                <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Gaji Minimum</th>
                                        <th>Denda Owner/Kasir</th>
                                        <th>Denda Weekday</th>
                                        <th>Denda Weekend</th>
                                        <th>Bonus Kerajinan</th>
                                        <th>Komisi Minimal Kepala</th>
                                        <th>Komisi per Transaki</th>
                                        <th>Tipe Gaji</th> 
                                        <th width="2000px">Action</th>
                                    </tr>
                                </thead>
                            
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>