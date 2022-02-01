<?php
function getDay($date)
{
    $day=date('w', strtotime($date));
    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    return $days[$day];
}
function formatDate($date)
{
    $day=date('d-m-Y', strtotime($date));
    return $day;
}
function formatBulan($date){
    $bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $date=explode('-', $date);
    $getMonth=$date[1];
    return $date[2].' '.$bulan[$getMonth-1].' '.$date[0];
}
?>
<style>
.table {
    width: 100%;
    font-size:14px
}
table td, table td * {
    vertical-align: top;
}
.table.bordered {
    border-collapse: collapse;
    border: 1px solid black;
}

.bordered th, .bordered td {
    border: 1px solid black;
    padding: 5px;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}
body{
    font-size:12px
}
</style>
<body class="page">
<table style="height: 160px; width: 80%;">
    <tbody>
        <tr>    
            <td><img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Lambang_Kota_Blitar.png" alt="" width="110" height="100"/>
            <td align="center">
                <span style="font-size:18px"><strong>DEWAN PERWAKILAN RAKYAT DAERAH<br>
                KOTA&nbsp; BLITAR</strong></span><br>
                <span style="font-size:18px">JL. A. Yani No. 19 Telp. (0342) 801602</span><br>
                Situs web : http://setwan.blitarkota.go.id e-mail : setwan@blitarkota.go.id<br>
                <span style="font-size:18px"><strong>B L I T A R</strong></span>
            </td>
        </tr>
    </tbody>
</table>

    <center><h3><strong><u>LAPORAN PERJALANAN DINAS</u></strong></h3></center>
    <table width="100%" class="table" border="1">
        <tbody>
            <tr>
                <td width="39">
                    <p>1.</p>
                </td>
                <td width="195">
                    <p>DASAR</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <p><?=$row_kunjungan->dasar?></p>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>2.</p>
                </td>
                <td width="195">
                    <p>MAKSUD DAN TUJUAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <p><?=$row_kunjungan->tujuan?></p>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>3.</p>
                </td>
                <td width="195">
                    <p>WAKTU PELAKSANAAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                <?=formatBulan($row_kunjungan->awal_waktu_pelaksanaan)?> s/d <?=formatBulan($row_kunjungan->ahir_waktu_pelaksanaan)?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>4.</p>
                </td>
                <td width="195">
                    <p>NAMA PETUGAS</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?php
                    $index=0;
                    foreach($anggota as $row){
                        $index++;
                        echo $index.'. '.$row->nama_pegawai.'<br>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>5.</p>
                </td>
                <td width="195">
                    <p>DAERAH TUJUAN / INSTANSI YANG DIKUNJUNGI</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?php 
                        echo $sub_tipe->nama.' ';
                     ?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>6.</p>
                </td>
                <td width="195">
                    <p>HADIR DALAM PERTEMUAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?=$row_kunjungan->undangan?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>7.</p>
                </td>
                <td width="195">
                    <p>MATERI</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?=$row_kunjungan->materi?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>8.</p>
                </td>
                <td width="195">
                    <p>Hasil</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                </td>
            </tr>
            <?php 
                if($row_kunjungan->hasil!=''){
            ?>
            <tr>
                <td colspan="4">
                <?= $row_kunjungan->hasil?>
                </td>
            </tr>
            <?php  } ?>
            <tr>
                <td width="39">
                    <p>9.</p>
                </td>
                <td width="195">
                    <p>SARAN TINDAKAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                <?=$row_kunjungan->saran?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>10.</p>
                </td>
                <td width="195">
                    <p>LAIN- LAIN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                <?=$row_kunjungan->lain?>
                </td>
            </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <table width="100%">
        <tbody>
            <tr>
                <td width="60%"></td>
                <td align="center">
                    <?=formatBulan(date('Y-m-d'))?></br>
                    PELAPOR
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td align="center">
                <p><strong><u> <?=$row_kunjungan->pelapor ?></u></strong></p>

                    <!-- <p><strong><u>dr. SYAHRUL ALIM</u></strong></p> -->
                </td>
            </tr>
        </tbody>
    </table>
</body>