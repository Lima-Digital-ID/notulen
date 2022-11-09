<div class="card shadow py-2">
    <div class="card-body">
        <div class="row">
            <!-- Column -->
            <div class="col-md-12 col-lg-12 col-xlg-12 text-center" style="margin-bottom: 20px;">
                <span class="db"><img witdh="250px" height="300px" src="<?=base_url('assets/')?>theme/assets/images/logo3.png" alt="logo" /></span>
                <h1>Selamat Datang di</h1>
                <h1>Aplikasi E-Radar</h1>
                <h1>Elektronik Rapat Sekretariat DPRD Kota Blitar</h1>
                <!--<h3 class="font-weight-bold">Tahun <?= date('Y') ?></h3>-->
            </div>
            <?php 
                if(isset($menu)){
                    foreach ($menu as $key => $value) {
                        $isSub = $value['is_sub']==1 ? '/sub' : '';
                        $link = $tipeMenu.'/tahun'.$isSub."?id_menu=".$value['id_menu'];
                        if($tipeMenu=='rapat'){
                            $count = $this->Admin_model->countJenisRapat($value['id_menu']);
                        }
                        else if($tipeMenu=='kunjungan'){
                            $count = $this->Admin_model->countJenisKunjungan($value['id_menu']);
                        }
                        else if($tipeMenu=='tinjauan'){
                            $link = 'sidak/sidaktahun'.$isSub."?id_menu=".$value['id_menu'];
                            $count = $this->Admin_model->countJenisSidak($value['id_menu']);
                        }
                ?>
            <div class="col-md-6 col-lg-4 col-xlg-4">
                <a href="<?=base_url($link)?>">
                    <div class="card card-hover">
                        <div style="height: 160px;" class="box bg-danger text-center">
                            <h1 style="margin-top: 10px;" class="font-light text-white"><i class="mdi mdi-account-multiple"></i></i></h1>
                            <h4 class="text-white"><?= ucwords($tipeMenu)." ".$value['menu'] ?></h4>
                            <h2 class="text-white"><?= $count ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <?php } } else{ ?>
            <div class="col-4">
                <a href="dashboard/rapat">
                    <div class="card card-hover">
                        <div style="height: 160px;" class="box bg-danger text-center">
                            <h1 style="margin-top: 10px;" class="font-light text-white"><i class="mdi mdi-account-multiple"></i></i></h1>
                            <h4 class="text-white">Rapat</h4>
                            <h2 class="text-white"><?= $rapat ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="dashboard/kunjungan">
                    <div class="card card-hover">
                        <div style="height: 160px;" class="box bg-danger text-center">
                            <h1 style="margin-top: 10px;" class="font-light text-white"><i class="mdi mdi-account-multiple"></i></i></h1>
                            <h4 class="text-white">Kunjungan Kerja</h4>
                            <h2 class="text-white"><?= $kunjungan ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="dashboard/tinjauan">
                    <div class="card card-hover">
                        <div style="height: 160px;" class="box bg-danger text-center">
                            <h1 style="margin-top: 10px;" class="font-light text-white"><i class="mdi mdi-account-multiple"></i></i></h1>
                            <h4 class="text-white">Tinjauan Lapangan</h4>
                            <h2 class="text-white"><?= $sidak ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
