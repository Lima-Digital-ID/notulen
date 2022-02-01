<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            
        </div>
    </div>
</div>

 <?php
 function formatTime($time){
    $jam=strtotime($time);
    return date('H:i', $jam);
 }
 ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cetak Laporan Pengiriman</div>
                <div class="card-body">
                    <form action="<?=base_url('welcome/print_report_detail')?>" method="post" target="_blank">
                        <div class="form-group" <?=$id_pegawai != null ? 'hidden' : ''?>>
                            <label for="exampleInputEmail1">Pilih Pegawai</label>
                            <select id="id_pegawai" class="form-control select2" name="id_pegawai" style="width:100%" required>
                                <option value="">--- Pilih Pegawai ---</option>
                                <?php foreach ($data_pegawai as $key => $value) {
                                ?>
                                <option value="<?=$value->id_pegawai?>" <?=$id_pegawai == $value->id_pegawai ? 'selected' : ''?> ><?=$value->nama_pegawai?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>   
                        <div class="form-group">
                            <label>Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?=date('Y-m-d')?>">
                        </div> 
                        <button class="btn btn-info">Cetak <i class="mdi mdi-printer"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>