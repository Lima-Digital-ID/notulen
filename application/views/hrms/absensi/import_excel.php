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
            <section class="card card-featured mb-4">
                <div class="card-header">
                    <h2 class="card-title"><?=$title?></h2>
                </div>
                <div class="card-body">
                   <form action="<?php echo base_url();?>index.php/hrms/absensi/upload" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label>Pilih Bulan : </label>
                                      <div class="form-inline">
                                        <select class="form-control select2" name="bulan" required>
                                            <option value="">--Pilih Bulan--</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>&nbsp;
                                        <select class="form-control select2" name="tahun" required>
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
                                <div class="col-sm-12">
                                      <label for="exampleInputFile">File input</label>
                                      <div>  
                                        <input type="file" name="file" />
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Upload File</button>
                                </div>
                            </div>
                        </div>
                   </form>
                </div>
            </section>
        </div>
    </div>
</section>