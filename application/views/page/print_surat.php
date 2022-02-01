<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Surat</title>

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
  .floatLeft { width: 50%; float: left; }
  .floatRight {width: 50%; float: right; }
  .container { overflow: hidden; }
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
	  <h1 style="text-align: center;"><span>Surat Jalan</span>
		<span style="font-size:12px;"></span><br>
        <span style="font-size:12px;"></span>
	  </h2>
	  <!--<h4 style="text-align: left;">Ruko Atrani 24 - Sukorahayu - Wagir - Telp. (0341) 806305</h4>-->
	</div>
<hr />
<!-- <h3 style="text-align: center;"><span style="text-decoration: underline;">Slip Gaji</span></h3> -->
<table style="padding:0px 0px">
	<thead>
        <tr>
            <td>Nama Pegawai</td>
            <td>:</td>
            <td><?=$detail[0]->nama_pegawai?></td>
        </tr>
		<tr>
            <td>Jenis Surat</td>
            <td>:</td>
            <td></td>
            
        </tr>
	</thead>
</table>
<br>
<div class="container">
<?php
$total_data=count($detail);
$div=$total_data / 2;
$a=$b=0;
for ($i=0; $i < 2; $i++) { 
?>

<div  class="<?= $i == 0 ? 'floatLeft' : 'floatRight'?>">
<table style="padding:0px 0px; border : 1px solid black" id="table">
	<thead>
        <tr>
            <th>No</th>
            <th>No Barcode</th>
            <th>Tanggal Kirim</th>
        </tr>
	</thead>
	<tbody>
		<?php 
    $initiate=($i == 0 ? 0 : floor($div) );
    for ($j=$b; $j < ($i == 0 ? ceil($div) : $total_data); $j++) { 
			$a++;
		?>
		<tr>
			<td align="center"><?=$a?></td>
			<td align="center"><?=$detail[$j]->barcode_number?></td>
			<td align="center"><?=formatTanggal($detail[$j]->send_date)?></td>
		</tr>
		<?php
    }
    $b=$a;
		?>
	</tbody>
</table>
</div>

<?php
}
?>
</div>
<br>
<table style="padding:0px 0px">
	<tfoot>
		<tr>
			<th>Jumlah</th>
			<th>:</th>
			<th><?=$a?></th>
		</tr>
	</tfoot>
</table>
<style>
#table {
  border-collapse: collapse;
  width: 100%;
}
#table th, #table td {
  border: 1px solid black;
}
</style>
  </section>

</body>
</html>
