<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'welcome/galery' ?>">Galeri</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()."welcome/galleryCategory/".$this->uri->segment(3) ?>"><?php echo $this->uri->segment(3)=='all' ? 'Semua Galeri' : 'Galeri '.ucfirst($this->uri->segment(3)) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo tipe($this->uri->segment(4)) ?></li>
                        <?php 
                            if(!empty($this->uri->segment(5))){
                                $sub = "?sub=".$this->uri->segment(5);
                        ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo subtipe(tipe($this->uri->segment(4)),$this->uri->segment(5)) ?></li>
                        <?php } else{
                            $sub = "";
                        } ?>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="card shadow py-2">
    <div class="card-body">
        <div class="row">
        <?php 
            foreach($dir as $dir){
        ?>
            <div class="col-md-3">
                <a href="<?php echo $url."/".$this->uri->segment(4)."/".$dir['date'].$sub ?>">
                    <div class="card card-hover">
                        <div class="py-5 box bg-danger text-center">
                            <i class="fas fa-fw fa-calendar text-white fa-6x"></i>
                            <h3 class="text-white mt-3"><?php echo date('d-m-Y', strtotime($dir['date'])) ?></h3>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>