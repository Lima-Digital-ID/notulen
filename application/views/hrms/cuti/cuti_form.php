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
            if($this->session->flashdata('message_type') == 'error')
                echo alert('alert-danger', 'Gagal', $this->session->flashdata('message'));
        ?>
        </div>
        <div class="col-md-5">
            <section class="card card-featured mb-4">
                <div class="card-header">
                    <h4><?=$title?></h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" action="<?=current_url(); ?>" method="post" autocomplete="off">
                         <div hidden>
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
                                </select>
                            </div>
                        </div>
                            <br>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        Nama Pegawai
                                    </div>
                                    <div class="col-lg-6">
                                        : <?=$pegawai->nama_pegawai?>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" placeholder="Id Pegawai"  value="<?=$id_pegawai?>" />
                            <label class="col-lg-3">
                                Tanggal
                            </label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="tanggal" required min="<?=$date.'-01'?>" max="<?=$date.'-'.$jumlah_hari?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>Create</button> 
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
                    <h4>List Cuti Pegawai <span id="title"></span></h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" action="<?=current_url()?>" method="post">
                         <div class="">
                            <div class="form-inline">
                                <label>Pilih Bulan : </label>&nbsp;
                                <select data-plugin-selectTwo class="form-control select2" name="bulan" id="bulan_form" required value="<?=$bulan?>">
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
                                <select data-plugin-selectTwo class="form-control select2" name="tahun" id="tahun_form" required>
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
                    </form>
                    <br>
                    <table class="table table-responsive-md mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Cuti</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a=0;
                                foreach ($list_cuti as $key => $value) {
                                    $a++;
                            ?>
                            <tr>
                                <td><?=$a?></td>
                                <td><?=$value->tanggal?></td>
                                <td><a href="<?=base_url('hrms/cuti/delete_cuti/').$value->id.'/'.$id_pegawai.'/'.$date?>" class="btn btn-sm btn-danger" title="hapus"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php
                                }
                            ?>
                            
                        </tbody>
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
    var bulan='<?=$bulan?>';
    var tahun='<?=$tahun?>';
    $( "#tanggal" ).datepicker({
      dateFormat: "dd-mm-yy"
    });
</script>