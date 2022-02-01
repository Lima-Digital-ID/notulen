<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
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
                <div class="card-header">Pilih Absensi</div>
                <div class="card-body">
                    <div class="row">
                        <?php 
                            foreach ($tipe_pegawai as $key => $value) {
                        ?>
                            <div class="col-md-4">
                            <a href="?id_tipe=<?= $value['id_tipe'] ?>">
                                <div class="text-center p-5 img-thumbnail">
                                    <h4> <?= $value['tipe'] ?></h4>
                                </div>
                                </a>                                
                                <br>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>