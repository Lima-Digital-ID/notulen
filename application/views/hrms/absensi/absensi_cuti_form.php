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
        <div class="col-md-5">
            <section class="card card-featured mb-4">
                <div class="card-header">
                    <h4><?=$title?></h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" action="<?php echo $action; ?>" method="post">
                         <div class="col-sm-12">
                            <div class="form-inline">
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
                                <button class="btn btn-primary"  onclick="cekAbsensiDate()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_set_gaji" id="id_set_gaji" placeholder="Id Jabatan"  value="" />
                            <label class="col-lg-3">
                                Tanggal
                            </label>
                            <div class="col-lg-12">
                                <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="tanggal" required value="<?=date('Y-m-d')?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3">
                                Pegawai
                            </label>
                            <div class="col-lg-12">
                               <?php echo form_dropdown('id_pegawai',$pegawai_option,'',array('id'=>'id_pegawai','data-plugin-selectTwo'=>'','class'=>'form-control select2', 'required'=>'required'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3">
                                Durasi Lembur
                            </label>
                            <div class="col-lg-12">
                                <input type="number" class="form-control" name="durasi" id="durasi" placeholder="Durasi" required/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-md-7">
            <section class="card card-featured mb-4">
                <div class="card-header">
                    <h4>List Cuti Pegawai</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            
                        </tbody>
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