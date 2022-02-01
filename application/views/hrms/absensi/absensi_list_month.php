<?php
function formatTime($time){
    if ($time != '') {
        $timeTemp=explode(':', $time);
        return $timeTemp[0].':'.$timeTemp[1]. ' WIB';
    }else{
        return '-';
    }
}
?>
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
                        <div class="row">
                            <form accept="<?=current_url()?>" method="post">
                                <center>
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
                                            <label>Pilih Pegawai : </label>&nbsp;
                                            <?php echo form_dropdown('id_pegawai',$pegawai_option,$id_pegawai,array('id'=>'id_pegawai','class'=>'form-control select2', 'data-plugin-selectTwo'=>'', 'required'=>'required'));?>
                                            &nbsp;
                                            <button class="btn btn-primary"  onclick="cekAbsensiDate()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                        <th>tanggal</th>
                                <?php 
                                for ($i=0; $i < 10; $i++) { 
                                ?>
                                        <th  class="text-center"><?php print_r($absensi['data'][$i]['tanggal']) ?></th>
                                <?php
                                }
                                ?>
                                    </tr>
                                    <tr>
                                        <th>jam datang</th>
                                <?php 
                                for ($i=0; $i < 10; $i++) { 
                                ?>
                                        <th  class="text-center"><?=formatTime($absensi['data'][$i]['jam_datang']) ?></th>
                                <?php
                                }
                                ?>
                                    </tr>
                                    <tr>
                                        <th>jam pulang</th>
                                <?php 
                                for ($i=0; $i < 10; $i++) { 
                                ?>
                                        <th  class="text-center"><?=formatTime($absensi['data'][$i]['jam_pulang']) ?></th>
                                <?php
                                }
                                ?>
                                </tr>
                                <tr>
                                        <th>Action</th>
                                <?php 
                                for ($i=0; $i < 10; $i++) { 
                                ?>
                                        <th  class="text-center"><?=anchor('hrms/absensi/update/'.$id_pegawai.'/'.$absensi['data'][$i]['date'], '<i class="fa fa-edit"></i>', array('class'=>'btn btn-sm btn-success', 'title'=>'edit')) ?></th>
                                <?php
                                }
                                ?>
                                </tr>
                            </thead>            
                        </table>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                        <th>tanggal</th>
                                <?php 
                                for ($i=10; $i < 20; $i++) { 
                                ?>
                                        <th  class="text-center"><?php print_r($absensi['data'][$i]['tanggal']) ?></th>
                                <?php
                                }
                                ?>
                                    </tr>
                                    <tr>
                                        <th>jam datang</th>
                                <?php 
                                for ($i=10; $i < 20; $i++) { 
                                ?>
                                        <th  class="text-center"><?=formatTime($absensi['data'][$i]['jam_datang']) ?></th>
                                <?php
                                }
                                ?>
                                    </tr>
                                    <tr>
                                        <th>jam pulang</th>
                                <?php 
                                for ($i=10; $i < 20; $i++) { 
                                ?>
                                        <th class="text-center"><?=formatTime($absensi['data'][$i]['jam_pulang']) ?></th>
                                <?php
                                }
                                ?>
                                </tr>
                                <tr>
                                        <th>Action</th>
                                <?php 
                                for ($i=10; $i < 20; $i++) { 
                                ?>
                                        <th  class="text-center"><?=anchor('hrms/absensi/update/'.$id_pegawai.'/'.$absensi['data'][$i]['date'], '<i class="fa fa-edit"></i>', array('class'=>'btn btn-sm btn-success', 'title'=>'edit')) ?></th>
                                <?php
                                }
                                ?>
                                </tr>
                            </thead>            
                        </table>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                        <th>tanggal</th>
                                <?php 
                                for ($i=20; $i < $jumlah_hari; $i++) { 
                                ?>
                                        <th  class="text-center"><?php print_r($absensi['data'][$i]['tanggal']) ?></th>
                                <?php
                                }
                                ?>
                                    </tr>
                                    <tr>
                                        <th>jam datang</th>
                                <?php 
                                for ($i=20; $i < $jumlah_hari; $i++) { 
                                ?>
                                        <th  class="text-center"><?=formatTime($absensi['data'][$i]['jam_datang']) ?></th>
                                <?php
                                }
                                ?>
                                    </tr>
                                    <tr>
                                        <th>jam pulang</th>
                                <?php 
                                for ($i=20; $i < $jumlah_hari; $i++) { 
                                ?>
                                        <th class="text-center"><?=formatTime($absensi['data'][$i]['jam_pulang']) ?></th>
                                <?php
                                }
                                ?>
                                </tr>
                                <tr>
                                        <th>Action</th>
                                <?php 
                                for ($i=20; $i < $jumlah_hari; $i++) { 
                                ?>
                                        <th  class="text-center"><?=anchor('hrms/absensi/update/'.$id_pegawai.'/'.$absensi['data'][$i]['date'], '<i class="fa fa-edit"></i>', array('class'=>'btn btn-sm btn-success', 'title'=>'edit')) ?></th>
                                <?php
                                }
                                ?>
                                </tr>
                            </thead>            
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script type="text/javascript">
    var bulan='<?=$bulan?>';
    var tahun='<?=$tahun?>';
</script>