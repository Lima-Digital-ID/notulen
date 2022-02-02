<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'welcome/galery' ?>">Galeri</a></li>
                        <li class="breadcrumb-item" ><a href="<?php echo base_url()."welcome/galleryCategory/".$this->uri->segment(3) ?>"><?php echo $this->uri->segment(3)=='all' ? 'Semua Galeri' : 'Galeri '.ucfirst($this->uri->segment(3)) ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()."welcome/galleryByDate/".$this->uri->segment(3)."/".$this->uri->segment(4) ?>"><?php echo tipe($this->uri->segment(4)) ?></a></li>
                        <?php 
                            if(!empty($_GET['sub'])){
                        ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo subtipe(tipe($this->uri->segment(4)),$_GET['sub']) ?></li>
                        <?php } ?>

                        <li class="breadcrumb-item active" aria-current="page"><?php echo date("d-m-Y", strtotime($this->uri->segment(5))) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="card shadow py-2">
    <div class="card-body">
        <div class="row">

<?php foreach ($galeri as $g) { ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3 rounded">
                    <div class="card card-hover">
                    <div  class="box bg-danger text-center">
                    <div class="text-center justify-center">
                                            <img style="width: 200px; height:250px; padding: 10px;" src="<?php echo base_url('assets/images/bukti_rapat/' . $g->file); ?>" alt="">
                                            <h5 style="margin-left: 10px; margin-top: 12px;" class="text-white">Dokumentasi <?= ucwords(str_replace('sidak','Tinjauan Lapangan', $this->uri->segment(3))); ?> : <?= ucwords($g->nama); ?></h5>
                                            </div>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    </div>
    </div>
</div>
