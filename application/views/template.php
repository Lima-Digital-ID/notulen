<?php
$role_id=$this->session->userdata('role');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/')?>theme/assets/images/logo-icon2.png">
    <title><?php echo (!empty($title) ? $title : '')?></title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>theme/assets/libs/select2/dist/css/select2.min.css">
    <link href="<?=base_url('assets/')?>theme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>theme/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>theme/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="<?=base_url('assets/')?>theme/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>theme/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>theme/assets/libs/ckeditor/samples/css/samples.css"> -->
    <!-- Custom CSS -->
    <link href="<?=base_url('assets/')?>theme/dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url() . "assets/" ?>sig/css/jquery.signaturepad.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->

                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="<?=base_url('assets/')?>theme/assets/images/logo3.png" alt="homepage" class="dark-logo"  /> -->
                            <!-- <img src="<?=base_url('assets/')?>theme/assets/images/logo-icon2.png" alt="homepage" class="dark-logo"  /> -->
                            <!-- Light Logo icon -->
                                
                            <img src="<?=base_url('assets/')?>theme/assets/images/logo3.png" alt="homepage" class="light-logo" style="width:60px"  />
                            <!-- <img src="<?=base_url('assets/')?>theme/assets/images/logo-light-icon.png" alt="homepage" class="light-logo"/> -->
                            <!-- <h2 class="light-logo">coolio</h2> -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <!-- <img src="<?=base_url('assets/')?>theme/assets/images/logo_white.png" alt="homepage" class="dark-logo" /> -->
                             <!-- Light Logo text -->    
                             <img src="<?=base_url('assets/')?>theme/assets/images/logo-light-icon.png" alt="homepage" style="width:30px"/>

                             <img src="<?=base_url('assets/')?>theme/assets/images/logo-light-text2.png" style="width:120px" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?=base_url('assets/')?>theme/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class=""><img src="<?=base_url('assets/')?>theme/assets/images/users/1.jpg" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?=$this->session->userdata('username')?></h4>
                                        <p class=" m-b-0"><?=$this->session->userdata('mobile')?></p>
                                    </div>
                                </div>
                                
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?=base_url('auth/logout')?>">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                </a>
                                <div class="dropdown-divider"></div>
                                <div hidden class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        
                        <li hidden class="p-15 mt-2"><a href="javascript:void(0)" class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i class="fa fa-plus-square"></i> <span class="hide-menu ml-1">Create New</span> </a></li>
                        <!-- User Profile-->
                        <li class="sidebar-item selected"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><span class="hide-menu">
                        <center>
                        <img src="<?=base_url('assets/')?>theme/assets/images/logo3.png" alt="homepage" style="width:70px"  />
                        </center>

                        <img src="<?=base_url('assets/')?>theme/assets/images/logo-light-icon.png" alt="homepage" width="20%" class="light-logo"/>
                        <img src="<?=base_url('assets/')?>theme/assets/images/logo-light-text2.png" class="light-logo" width="80%" alt="homepage" />

                        </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Welcome/dashboard')?>" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Dashboard</span></a></li>


                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Kunjungan </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('kunjungan')?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Kunjungan All</span></a></li>

                            <?php 
                                $menuKunjungan = $this->Admin_model->menu(['is_kunjungan' => '1'])->result_array();

                                foreach ($menuKunjungan as $value) {
                                    if($value['is_sub']=='1'){
                            ?>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu" >Kunjungan <?= $value['menu'] ?> </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                <?php 
                                    $subMenuKunjungan = $this->Admin_model->submenu(['is_kunjungan' => '1','id_menu' => $value['id_menu']])->result_array();

                                    foreach ($subMenuKunjungan as $sub) {
                                ?>
                                    <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('kunjungan?jenis='.$value['id_menu'].'&sub='.$sub['id_sub_menu'])?>" aria-expanded="false"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"><?= $sub['sub_menu'] ?></span></a></li>
                                <?php  } ?>
                                </ul>
                            </li>
                            <?php
                                    }
                                    else{
                            ?>
                            <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('kunjungan?jenis='.$value['id_menu'])?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Kunjungan <?= $value['menu'] ?></span></a></li>
                            <?php } }  ?>
                                
                             
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-incognito"></i><span class="hide-menu">Tinjauan Lapangan </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('sidak')?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Tinjauan Lapangan All</span></a></li>

                            <?php 
                                $menuTinjauan = $this->Admin_model->menu(['is_tinjauan' => '1'])->result_array();

                                foreach ($menuTinjauan as $value) {
                                    if($value['is_sub']=='1'){
                            ?>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu"><?= $value['menu'] ?> </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                <?php 
                                    $subMenuTinjauan = $this->Admin_model->submenu(['is_tinjauan' => '1','id_menu' => $value['id_menu']])->result_array();
                                        foreach ($subMenuTinjauan as $sub) {
                                ?>
                                    <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('sidak?jenis='.$value['id_menu'].'&sub='.$sub['id_sub_menu'])?>" aria-expanded="false"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"><?= $sub['sub_menu'] ?></span></a></li>
                                <?php }  ?>
                                </ul>
                            </li>
                            <?php
                                    }
                                    else{
                            ?>
                            <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('sidak?jenis='.$value['id_menu'])?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu"><?= $value['menu'] ?></span></a></li>
                            <?php } }  ?>
                                
                             
                            </ul>
                        </li>
                        <li class="sidebar-item <?=$role_id != 1 ? 'hidden' : ''?>"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Welcome/galery')?>" aria-expanded="false"><i class="mdi mdi-folder-image"></i><span class="hide-menu">Galeri</span></a></li>

                        <!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-image"></i><span class="hide-menu">Galeri </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Welcome/galery')?>" aria-expanded="false"><i class="mdi mdi-folder-image""></i><span class="hide-menu">ALL</span></a></li>
                                <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Welcome/galery_rapat')?>" aria-expanded="false"><i class="mdi mdi-folder-image"></i><span class="hide-menu">Galeri Rapat</span></a></li>
                                <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Welcome/galery_kunjungan')?>" aria-expanded="false"><i class="mdi mdi-folder-image"></i><span class="hide-menu">Galeri Kunjungan</span></a></li>
                                <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('Welcome/galery_sidak')?>" aria-expanded="false"><i class="mdi mdi-folder-image"></i><span class="hide-menu">Galeri Sidak</span></a></li>
                                
                               
                            </ul>
                        </li> -->
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Rapat </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('rapat')?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Rapat All</span></a></li>
                            <?php 
                                $menuRapat = $this->Admin_model->menu(['is_rapat' => '1'])->result_array();
                                foreach ($menuRapat as $value) {
                                    if($value['is_sub']=='1'){
                                        $subMenuRapat = $this->Admin_model->submenu(['is_rapat' => '1','id_menu' => $value['id_menu']])->result_array();
                            ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Rapat <?= $value['menu'] ?> </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                <?php 
                                    foreach ($subMenuRapat as $sub) {
                                ?>
                                    <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('rapat?tipe='.$value['id_menu'].'&sub='.$sub['id_sub_menu'])?>" aria-expanded="false"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"><?= $sub['sub_menu'] ?></span></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                            <?php
                                    }
                                    else{
                            ?>
                            <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('rapat?tipe='.$value['id_menu'])?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Rapat <?= $value['menu'] ?></span></a></li>
                            <?php } } ?>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-gnome"></i><span class="hide-menu">Daftar Hadir </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php 
                                    $getTipe = $this->Admin_model->getData('*','tipe_pegawai','','','')->result_array();
                                    foreach ($getTipe as $key => $value) {
                                ?>
                                <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('absensi?id_tipe='.$value['id_tipe'])?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu"><?= $value['tipe'] ?></span></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                      
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Data Base</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php
                                    $getTipePegawai = $this->Admin_model->getData('*','tipe_pegawai','','','')->result_array();
                                    foreach ($getTipePegawai as $key => $value) {
                                    ?>
                                        <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('pegawai?tipe='.$value['id_tipe'])?>" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu"><?= $value['tipe'] ?></span></a></li>
                                    <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('jabatan')?>" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Jabatan</span></a></li>

                        <li class="sidebar-item" <?=$role_id != 1 ? 'hidden' : ''?> > <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('user')?>" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">User</span></a></li>
                       
                        <li hidden class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tune-vertical"></i><span class="hide-menu">Sidebar Type </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="sidebar-type-minisidebar.html" class="sidebar-link"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Minisidebar </span></a></li>
                                <li class="sidebar-item"><a href="sidebar-type-iconsidebar.html" class="sidebar-link"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Icon Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="sidebar-type-overlaysidebar.html" class="sidebar-link"><i class="mdi mdi-view-day"></i><span class="hide-menu"> Overlay Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="sidebar-type-fullsidebar.html" class="sidebar-link"><i class="mdi mdi-view-array"></i><span class="hide-menu"> Full Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="sidebar-type-horizontalsidebar.html" class="sidebar-link"><i class="mdi mdi-view-module"></i><span class="hide-menu"> Horizontal Sidebar </span></a></li>
                            </ul>
                        </li>
                        <li hidden class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-content-copy"></i><span class="hide-menu">Page Layouts </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="layout-inner-fixed-left-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-align-left"></i><span class="hide-menu"> Inner Fixed Left Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="layout-inner-fixed-right-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-align-right"></i><span class="hide-menu"> Inner Fixed Right Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="layout-inner-left-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-float-left"></i><span class="hide-menu"> Inner Left Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="layout-inner-right-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-float-right"></i><span class="hide-menu"> Inner Right Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="page-layout-fixed-header.html" class="sidebar-link"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Fixed Header </span></a></li>
                                <li class="sidebar-item"><a href="page-layout-fixed-sidebar.html" class="sidebar-link"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Fixed Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="page-layout-fixed-header-sidebar.html" class="sidebar-link"><i class="mdi mdi-view-column"></i><span class="hide-menu"> Fixed Header &amp; Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="page-layout-boxed-layout.html" class="sidebar-link"><i class="mdi mdi-view-carousel"></i><span class="hide-menu"> Box Layout </span></a></li>
                            </ul>
                        </li>
                        <li hidden class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Apps</span></li>
                        <li hidden class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">Inbox </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="inbox-email.html" class="sidebar-link"><i class="mdi mdi-email"></i><span class="hide-menu"> Email </span></a></li>
                                <li class="sidebar-item"><a href="inbox-email-detail.html" class="sidebar-link"><i class="mdi mdi-email-alert"></i><span class="hide-menu"> Email Detail </span></a></li>
                                <li class="sidebar-item"><a href="inbox-email-compose.html" class="sidebar-link"><i class="mdi mdi-email-secure"></i><span class="hide-menu"> Email Compose </span></a></li>
                            </ul>
                        </li>
                        <li hidden class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Ticket </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i class="mdi mdi-book-multiple"></i><span class="hide-menu"> Ticket List </span></a></li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i class="mdi mdi-book-plus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('auth/logout')?>" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Log Out</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <?php
        	    echo $contents;
            ?>	
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
       <!-- All Rights Reserved by Xtreme admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>. -->
</footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="<?= base_url('assets/') ?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('assets/sig') ?>/js/numeric-1.2.6.min.js"></script>
    <script src="<?= base_url('assets/sig') ?>/js/bezier.js"></script>
    <script src="<?= base_url('assets/sig') ?>/js/jquery.signaturepad.js"></script>
    <script src="<?= base_url('assets/sig') ?>/js/html2canvas.js" type='text/javascript'></script>
    <script src="<?= base_url('assets/sig') ?>/js/json2.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url('assets/')?>theme/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- select2 -->
    <script src="<?=base_url('assets/')?>theme/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/dist/js/pages/forms/select2/select2.init.js"></script>
    <!-- apps -->
    <script src="<?=base_url('assets/')?>theme/dist/js/app.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/dist/js/app.init.light-sidebar.js"></script>
    <script src="<?=base_url('assets/')?>theme/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=base_url('assets/')?>theme/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url('assets/')?>theme/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url('assets/')?>theme/dist/js/sidebarmenu.js"></script>
    
    <script src="<?=base_url('assets/')?>theme/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url('assets/')?>theme/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="<?=base_url('assets/')?>theme/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 charts -->
    <script src="<?=base_url('assets/')?>theme/assets/extra-libs/c3/d3.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/extra-libs/c3/c3.min.js"></script>
        
    <!--chartjs -->
    <script src="<?=base_url('assets/')?>theme/assets/libs/chart.js/dist/Chart.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/dist/js/pages/dashboards/dashboard1.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/extra-libs/jquery.repeater/repeater-init.js"></script>
    <script src="<?=base_url('assets/')?>theme/assets/extra-libs/jquery.repeater/dff.js"></script>
    <script>
    function formatDay(date){
        var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var d = new Date(date);
        var dayName = days[d.getDay()];
        return dayName
    }
    </script>
</body>

</html>