<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jumlah Kunjungan Tahun <?= date('Y') ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Rapat</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jenis Rapat</th>
                                    <th class="text-center">Jumlah Rapat</th>
                                    <th class="text-center">Jumlah Absensi</th>
                                    <th class="text-center" width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 0;
                                foreach ($data as $key => $value) {
                                    $no++;
                            ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $value['jenis'] ?></td>
                                <td><?= $value['jumlah'] ?></td>
                                <td><?= $value['absensi'] ?></td>
                                <td><a href="<?= $value['url'] ?>" class="btn btn-primary">Detail</a></td>
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $('#data_list').DataTable()
    })
</script>