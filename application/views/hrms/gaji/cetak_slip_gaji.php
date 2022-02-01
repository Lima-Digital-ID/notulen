<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Slip Gaji</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">-->
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" /> -->
  <!-- Load paper.css for happy printing -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">-->
  
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/paper-css/paper.css"> -->
  
  <style>
	.header img {
	  float: left;
	  width: 130px;
	  /*height: 100px;*/
      margin-top: -15px;
	}

	.header h2 {
	  position: relative;
	  top: 25px;
	  left: 20px;
	  font-size: 20px;
	}
  </style>

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <!-- 
  <style>@page { size: A4 }</style>
   -->
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<!-- <body class="A5 landscape" onload="window.print()"> -->
<!-- <body class="A4" onload="window.print()"> -->
<body onload="window.print()">
<?php 
// $kehadiran=$jumlah_kehadiran;
// $kom_min=($gaji != null ? $gaji->kom_min : 0 );
// $kom_level=($gaji != null ? $gaji->kom_level : 0);
// $uang_lembur=$uang_lembur;
// $tipe_gaji=($gaji != null ? $gaji->tipe_gaji : 0);
// $grand_total=$gaji != null ? (($gaji->gaji_pokok + $uang_lembur + ($gaji->tipe_gaji == 2 ? $gaji->kom_min : 0) + ($gaji->tipe_gaji == 3 ? $gaji->kom_level : 0) + ($gaji->tipe_gaji == 1 ? $komisi_langsung : 0)) - $jumlah_denda) : 0;
$kehadiran=$jumlah_kehadiran;
$kom_min=($gaji != null ? $gaji->kom_min : 0 );
$kom_level=($gaji != null ? $gaji->kom_level : 0);
$kom_trx=($gaji != null ? $gaji->kom_trx : 0);
$uang_lembur=$uang_lembur;
// $bonus_kerajinan=$jumlah_denda < 1500000 ? 300000 : 0;
$bonus_kerajinan=$jumlah_bolos < 1 ? $gaji->bonus_kerajinan : 0;
$tipe_gaji=($gaji != null ? $gaji->tipe_gaji : 0);
// $komisiperkepala=($gaji != null ? ($gaji->kom_min * ($komisiperpotong != null ? $komisiperpotong->total : 0)) : 0);
$komisiperkepala=($komisiperpotong != null ? $komisiperpotong : 0);
$hitung_gaji=$gaji != null ? (($gaji->gaji_pokok  + ($gaji->bonus_kerajinan != 0 ? $bonus_kerajinan : 0)+ $uang_lembur + ($gaji->tipe_gaji == 2 ? $komisiperkepala : 0) + ($gaji->tipe_gaji == 3 ? $komisiperkepala : 0) + ($gaji->tipe_gaji == 1 ? $komisi_langsung : 0) + ($gaji->tipe_gaji == 4 ? ($komisiperkepala) : 0))) : 0;
// $total_gaji=$gaji != null ? (($gaji->gaji_pokok + $uang_lembur + ($gaji->tipe_gaji == 2 ? $komisiperkepala : 0) + ($gaji->tipe_gaji == 3 ? $gaji->kom_level : 0) + ($gaji->tipe_gaji == 1 ? $komisi_langsung : 0) + ($gaji->tipe_gaji == 4 ? ($komisiperkepala + $bonus_kerajinan) : 0)) - $jumlah_denda) : 0;
$real_gaji=($gaji->gaji_min != 0 ? ($hitung_gaji < $gaji->gaji_min ? $gaji->gaji_min : $hitung_gaji) : $hitung_gaji);
$grand_total=$real_gaji - $jumlah_denda;
?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
<?php
    function bulan($date){
        $bulan = ['Jan', 'Feb', 'Mar','Apr','Mei','Juni','Juli','Agust','Sept','Okt','Nov','Des'];
        return $bulan[$date-1];
    }
    function formatCurrency($val){
        return number_format($val, 0, '.', '.');
    }
    function getMonth($month){
        $month=explode('-', $month);
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return $bulan[$month[1]-1].' '.$month[0];
    }
    function formatTanggal($val){
        $date=date('d-m-Y', strtotime($val));
        return $date;
    }
?>

    <!-- Write HTML just like a web page -->
    <!--<article>This is an A5 document.</article>-->
    <div class="header">
	  <img src="<?php echo base_url()?>assets/img/logo_coolio.png" alt="logo" />
	  <h1 style="text-align: center;"><span style="color: #3e4095;">Coolio Barbershop</span>
        <br>
		<span style="font-size:12px;"><?=$gaji->landmark?></span><br>
        <span style="font-size:12px;"><?='Mobile : '.$gaji->mobile?></span>
	  </h2>
	  <!--<h4 style="text-align: left;">Ruko Atrani 24 - Sukorahayu - Wagir - Telp. (0341) 806305</h4>-->
	</div>
<hr />
<h3 style="text-align: center;"><span style="text-decoration: underline;">Slip Gaji</span></h3>
<table width="100%" style="padding:0px 0px">
	<thead>
        <tr>
            <td>Nama Pegawai</td>
            <td>:</td>
            <td><?=$gaji->nama_pegawai?></td>
            <td width="50px"></td>
            <td>Nomor Telepon/HP</td>
            <td>:</td>
            <td><?=$gaji->no_hp?></td>
        </tr>
		<tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?=$gaji->nama_jabatan?></td>
            <td width="50px"></td>
            <td>Bulan</td>
            <td>:</td>
            <td><?=getMonth($bulan)?></td>
        </tr>
	</thead>
</table>
<br>
<style>
#table {
  border-collapse: collapse;
  width: 100%;
}

#table_th{
  padding-bottom: 5px;
  padding-top: 5px;
  /*text-align: left;*/
  border-bottom: 1px solid #000;
}
#tbl_padding{
  padding-top: 8px;
}
</style>
<table id="table">
    <thead style="border-top: 1px solid #000">
        <tr>
            <th colspan="6" align="left" id="table_th">Pendapatan</th>
            <th width="30px" id="table_th"></th>
            <th colspan="6" align="left" id="table_th">Potongan</th>
        </tr>
        <tr>
            <th id="table_th" align="left">Tipe</th>
            <th id="table_th" colspan="2">Fee</th>
            <th id="table_th">Kehadiran</th>
            <th id="table_th" align="right" colspan="2">Sub total</th>
            <th id="table_th"></th>
            <th id="table_th" align="left">Tipe</th>
            <th id="table_th" colspan="2">Fee</th>
            <th id="table_th">Kehadiran</th>
            <th id="table_th" colspan="2" align="right">Sub total</th>
        </tr>
        <tr>
            <th align="left" id="tbl_padding">Gaji Pokok</th>
            <td id="tbl_padding">Rp. </td>
            <td id="tbl_padding" align="right"><?=formatCurrency($gaji->gaji_pokok)?></td>
            <td id="tbl_padding"></td>
            <td id="tbl_padding" align="right">Rp. </td>
            <td id="tbl_padding" align="right"><?=formatCurrency($gaji->gaji_pokok)?></td>
            <th id="tbl_padding"></th>
            <th id="tbl_padding" align="left">Denda</th>
            <td id="tbl_padding">Rp. </td>
            <td id="tbl_padding" align="right"><?=formatCurrency($jumlah_denda)?></td>
            <td id="tbl_padding" align="center"></td>
            <td id="tbl_padding" align="right">Rp. </td>
            <td id="tbl_padding" align="right"><?=formatCurrency($jumlah_denda)?></td>
        </tr>
        <tr>
            <th align="left">Uang Lembur</th>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right">Rp. </td>
            <td align="right"><?=formatCurrency($uang_lembur)?></td>
            <td colspan="4"></td>
        </tr>
        <?php
            if ($tipe_gaji == 1) {
        ?>
        <tr>
            <th align="left">Komisi Langsung</th>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right">Rp. </td>
            <td align="right"><?=formatCurrency($komisi_langsung)?></td>
            <td colspan="4"></td>
        </tr>
        <?php
            }
            if ($tipe_gaji == 2) {
        ?>
        <tr>
            <th align="left">Komisi Minimal Kepala</th>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right">Rp. </td>
            <td align="right"><?=formatCurrency($komisiperkepala)?></td>
            <td colspan="4"></td>
        </tr>
        <?php
            }
            if ($tipe_gaji == 3) {
        ?>
        <tr>
            <th align="left">Komisi Bertingkat</th>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right">Rp. </td>
            <td align="right"><?=formatCurrency($komisiperkepala)?></td>
            <td colspan="4"></td>
        </tr>
        <?php
            }if ($tipe_gaji == 4) {
        ?>
        <tr>
            <th align="left">Komisi per Transaksi</th>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right">Rp. </td>
            <td align="right"><?=formatCurrency($komisiperkepala)?></td>
            <td colspan="4"></td>
        </tr>
        <?php
            }if ($gaji->bonus_kerajinan != 0) {
        ?>
        <tr>
            <th align="left">Bonus Kerajinan</th>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right">Rp. </td>
            <td align="right"><?=formatCurrency($bonus_kerajinan)?></td>
            <td colspan="4"></td>
        </tr>
        <?php
            }
        ?>
        <tr>
            <th align="left">Sub Total</th>
            <th colspan="5" align="right"><?=formatCurrency($hitung_gaji). ($hitung_gaji < $real_gaji ? ' < '.formatCurrency($real_gaji). '(Minimum Gaji)' : '')?></th>
            <td colspan="4"></td>
        </tr>
        <tr>
            <th colspan="11" align="left" id="table_th">Gaji Bersih</th>
            <th align="right" colspan="2" id="table_th">Rp. <?=formatCurrency($grand_total)?></th>
        </tr>
    </thead>
</table>
<table id="table">
	<thead>
		
	</thead>
</table>
<br>
<table width="100%">
<thead>
	<tr>
		<td align="left"></td>
		<td align="right">Surabaya, <?php echo date('d-m-Y');?></td>
	</tr>
	<tr>
		<td align="left">Penerima<br><br><br><br></td>
		<td align="right"><br><br><br><br><br></td>
	</tr>
	<tr style="margin-top:20pxs">
		<td align="left"><p>( <?=$gaji->nama_pegawai?> )</p></td>
		<td align="right"><p>( Coolio Barbershop )</p></td>
	</tr>
</thead>
</table>

<div style="col-sm-6">
<h4 class="title" style="color:black">Detail Denda</h4>
<table border="1px solid black" style="border-collapse:collapse" width="100%">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Alasan</th>
            <th align="center">Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($detail as $key => $value) {
        ?>
        <tr>
            <td><?=formatTanggal($value['tanggal'])?></td>
            <td><?=$value['alasan_denda']?></td>
            <td align="right">Rp. <?=formatCurrency($value['denda'])?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <th align="center" colspan="2">Total Denda</th>
            <th align="right">Rp. <?=formatCurrency($jumlah_denda)?></th>
        </tr>
    </tbody>
</table>
</div>

<?php if ($gaji->tipe_gaji == 2 || $gaji->tipe_gaji == 3 || $gaji->tipe_gaji == 4) {
    $tipe_gaji=$gaji->tipe_gaji;
?>

<div style="col-sm-6">
<h4 class="title" style="color:black">Detail Komisi</h4>
<table  border="1px solid black" style="border-collapse:collapse" width="100%">
    <thead>
        <tr>
            <th>Invoice No</th>
            <th>Tanggal</th>
            <th>Nama Jasa</th>
            <th>Total</th>
            <th align="center">Komisi</th>
            <th align="center">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($detail_jasa as $key => $value) {
            if ($tipe_gaji == 2) {
                $komisi=$value->commission;
            }else if ($tipe_gaji == 4) {
                $komisi=$kom_trx;
            }else{
                if ($value->is_paket == 1) {
                    $komisi=$value->commission;
                }else{
                    if(strpos($value->name, 'Paket') !== false){
                        $komisi=$value->commission;
                    }else if(strpos($value->name, 'Potong') !== false){
                        $komisi=$gaji->kom_min;
                    }else{
                        $komisi=$value->commission;
                    }
                }
            }
        ?>
        <tr>
            <td><?=$value->invoice_no?></td>
            <td><?=formatTanggal($value->transaction_date)?></td>
            <td><?=$value->name?></td>
            <td><?=round($value->quantity, 0)?></td>
            <td align="right">Rp. <?=formatCurrency($komisi)?></td>
            <td align="right">Rp. <?=formatCurrency($komisi * $value->quantity)?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <th align="center" colspan="5">Total Komisi</th>
            <th align="right">Rp. <?=formatCurrency($komisiperkepala)?></th>
        </tr>
    </tbody>
</table>
</div>
<?php
}
?>
  </section>

</body>
<script src="<?=base_url('assets/')?>vendor/jquery/jquery.js"></script>
<script>
    var bulan='<?=$bulan?>';
    console.log(bulan);
    var gaji_pokok="<?=($gaji != null ? $gaji->gaji_pokok : 0)?>";
    var uang_kehadiran="<?=($gaji != null ? $gaji->uang_kehadiran : 0)?>";
    var uang_makan="<?=$gaji != null ? $gaji->uang_makan : 0?>";
    var komisi_langsung="<?=$komisi_langsung?>";
    var uang_lembur="<?=$uang_lembur != ""? $uang_lembur : 0 ?>";
    // var tunjangan="<?=$gaji != null ? $gaji->tunjangan : 0?>";
    // var tunjangan1="<?=$gaji != null ? $gaji->tunjangan : 0?>";
    // var potongan_telat="<?=$gaji != null ? $gaji->potongan_telat : 0?>";
    var jumlah_denda="<?=$jumlah_denda?>";
    var kom_min="<?=$kom_min?>";
    var kom_level="<?=$kom_level?>";
    // var grand="<?=$grand_total?>";
</script>
<script type="text/javascript" src="<?=base_url('assets/')?>js/function/gaji.js"></script>
</html>
