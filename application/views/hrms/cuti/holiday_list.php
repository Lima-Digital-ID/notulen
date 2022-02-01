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
        <div class="col-md-12">
        <?php 
            if($this->session->flashdata('message_type') == 'success')
                echo alert('alert-success', 'Sukses', $this->session->flashdata('message')); 
        ?>
        </div>
        <div class="col-md-12">
        <?php 
            if($this->session->flashdata('message_type') == 'error')
                echo alert('alert-danger', 'Gagal', $this->session->flashdata('message'));
        ?>
    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured mb-4">
                <div class="card-body">
                    <div style="padding-bottom: 10px;">
                     <form action="<?=current_url()?>" method="post">
                        <div class="form-inline">
                            <?php echo anchor(site_url('hrms/cuti/create_holiday'), '<i class="fab fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-info"'); ?>
                            &nbsp;&nbsp;
                            <select data-plugin-selectTwo class="form-control select2" name="tahun" id="tahun" required>
                                <option value="">--Pilih Tahun--</option>
                                <?php for ($i = 2000; $i <= date('Y'); $i++) { 
                                ?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php
                                }
                                ?>
                            </select>&nbsp;
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                   </div>
                    <table class="table table-bordered table-striped" id="holiday_list">
                        <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                    
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
<script>
    var year=<?=$year?>;
</script>