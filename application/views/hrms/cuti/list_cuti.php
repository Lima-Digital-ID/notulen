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
                    <div style="padding-bottom: 10px;">
                        <form action="<?=current_url()?>" method="post">
                        <div class="form-inline">
                            <!-- <?php echo anchor(site_url('hrms/pegawai/create'), '<i class="fab fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-info btn-sm"'); ?> -->
                            <label>Pilih Bulan : </label>&nbsp;
                            <select data-plugin-selectTwo class="form-control select2" name="bulan" id="bulan" required value="<?=$bulan?>">
                                <option value="">--Pilih Bulan--</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            &nbsp;
                            <select data-plugin-selectTwo class="form-control select2" name="tahun" id="tahun" required>
                                <option value="">--Pilih Tahun--</option>
                                <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++) { 
                                ?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php
                                }
                                ?>
                            </select>&nbsp;
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            &nbsp;
                            <a href="<?=base_url('hrms/cuti/cuti_bersama')?>" class="btn btn-success">Cuti Bersama</a>
                        </div>
                        </form>
                   </div>

                    
                    <table class="table table-bordered table-striped" id="cuti_list">
                        <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal Cuti</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                    
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
<script type="text/javascript">
    var bulan='<?=$bulan?>';
    var tahun='<?=$tahun?>';
</script>