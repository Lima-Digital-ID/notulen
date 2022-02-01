<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'welcome/galery' ?>">Galeri</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'welcome/galleryCategory/'.$this->uri->segment(3) ?>"><?php echo $this->uri->segment(3)=='all' ? 'Semua Galeri' : 'Galeri '.ucfirst($this->uri->segment(3)) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo tipe($this->uri->segment(4)) ?></li>
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
            foreach ($subMenu as $value) {
        ?>
            <div class="col-md-3">
                <a href="<?php echo base_url()."welcome/galleryByDate/".$this->uri->segment(3)."/".$this->uri->segment(4).'/'.$value['id_sub_menu'] ?>">
                    <div class="card card-hover">
                        <div class="py-5 box bg-danger text-center">
                            <i class="fas fa-fw fa-folder text-white fa-6x"></i>
                            <h3 class="text-white mt-3"><?php echo $value['sub_menu'] ?></h3>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>