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
<br><hr><hr>
<table>
    <tbody>
        <tr>
            <td width="88">
                <p>Nomor</p>
            </td>
            <td width="23">
            </td>
            <td width="252">
                <p>090 / &nbsp;&nbsp;&nbsp;/Audiensi /XI/ 2020</p>
            </td>
            <td width="16">
            </td>
            <!-- <td width="214">
                <p>Kepada :</p>
            </td> -->
        </tr>
        <tr>
            <td width="88">
                <p>Sifat</p>
            </td>
            <td width="23">
                <p>:</p>
            </td>
            <td width="252">
                <p>Biasa</p>
            </td>
            <td width="16">
                <p>&nbsp;</p>
            </td>
            <td width="214">
                <p>Yth. Ketua &nbsp;DPRD</p>
            </td>
        </tr>
        <tr>
            <!-- <td width="88">
                <p>Lampiran</p>
            </td> -->
            <td width="23">
                <p>:</p>
            </td>
            <td width="252">
                <p>1 (satu) berkas</p>
            </td>
            <td width="16">
                <p>&nbsp;</p>
            </td>
            <td width="214">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;KOTA BLITAR</p>
            </td>
        </tr>
        <tr>
            <td width="88">
                <p>Perihal</p>
            </td>
            <td width="23">
                <p>:</p>
            </td>
            <td width="252">
                <p>Laporan Penerimaan Audiensi</p>
                <p>KRPK Blitar Tahun 2020</p>
                <p>-----------------------------------------</p>
            </td>
            <td width="16">
                <p>&nbsp;</p>
            </td>
            <td width="214">
                <p>&nbsp;&nbsp; Di -</p>
            </td>
        </tr>
        <tr>
            <td width="88">
                <p>&nbsp;</p>
            </td>
            <td width="23">
                <p>&nbsp;</p>
            </td>
            <td width="252">
                <p>&nbsp;</p>
            </td>
            <td width="16">
                <p>&nbsp;</p>
            </td>
            <td width="214">
                <p><strong><u>BLITAR</u></strong></p>
            </td>
        </tr>
        <tr>
            <td width="88">
                <p>&nbsp;</p>
            </td>
            <td width="23">
                <p>&nbsp;</p>
            </td>
            <td width="252">
                <p>&nbsp;</p>
            </td>
            <td width="16">
                <p>&nbsp;</p>
            </td>
            <td width="214">
                <p>&nbsp;</p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;I.&nbsp;&nbsp;&nbsp; PENDAHULUAN</h3>
<ol>
    <li>Dasar</li>
    <ul>
        <li>
        <p>Dasar Pelaksanaan Audiensi sebagai berikut :</p>
        <p><?=$row_kunjungan->dasar?></p>
        </li>
    </ul>
    <li>Tujuan</li>
    <ul>
        <li>
        <p><?=$row_kunjungan->tujuan?></p>
        </li>
    </ul>
    <li>Waktu, Tempat, dan Peserta
        <ol start="1">
            <li><strong><em>Waktu</em></strong>
                <br>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; Kamis &nbsp;</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal :&nbsp;&nbsp; <?=formatBulan($row_kunjungan->awal_waktu_pelaksanaan)?> s/d <?=formatBulan($row_kunjungan->ahir_waktu_pelaksanaan)?></p>
            </li>
        </ol>
        <ol start="2">
            <li><strong><em>Tempat </em></strong>
            <br>
            <?php 
                echo $sub_tipe->nama.' ';
            ?>
            </li>
        </ol>
        <ol start="3">
            <li><strong><em>Peserta </em></strong>
            <p>Penerima &nbsp;&nbsp;Audiensi &nbsp;KRPK &nbsp;adalah sebagai berikut &nbsp;:</p>
            <?=$row_kunjungan->undangan?>
                <ol>
            <?php foreach($pengikut as $p){ ?>
                
                <li>
                <p><?= $p->nama; ?></p>
                </li>
            <?php } ?>
                </ol>
            </li>
        </ol>
    </li>
    <li>Sistematika Laporan</li>
    <ol>
        <li>Pendahuluan</li>
    </ol>
    <ol start="2">
        <li>Materi dan hasil kegiatan</li>
    </ol>
    <ol start="3">
        <li>Kesimpulan</li>
    </ol>
    <ol start="4">
        <li>Penutup</li>
    </ol>
</ol>
<h3>&nbsp;&nbsp;&nbsp;&nbsp; II.&nbsp;&nbsp; MATERI DAN HASIL KUNJUNGAN KERJA</h3>
<ol>
    <li>Materi
    <br>
    <?=$row_kunjungan->materi?>
    </li>
    <li>Hasil
    <br>
    <?=$row_kunjungan->hasil?>
    </li>
</ol>
<p><strong>&nbsp;</strong></p>
<h3>&nbsp;&nbsp;&nbsp;&nbsp; III.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KESIMPULAN</h3>
<p>&nbsp;</p>
<ol>
<li>
<?=$row_kunjungan->kesimpulan?>
</li>
</ol>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>&nbsp;&nbsp;&nbsp;&nbsp; IV. PENUTUP</h3>
<?=$row_kunjungan->penutup?>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<table width="558">
    <tbody>
        <tr>
            <td width="558">
                <p>Blitar, <?=formatBulan($row_kunjungan->awal_waktu_pelaksanaan)?></p>
            </td>
        </tr>
        <tr>
            <td width="558">
                <p><strong>DEWAN&nbsp; &nbsp;PERWAKILAN &nbsp;RAKYAT &nbsp;DAERAH</strong></p>
            </td>
        </tr>
        <tr>
            <td width="558">
                <p><strong>KOTA &nbsp;BLITAR</strong></p>
                <p>Penerima Audiensi,</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<table width="614">
    <tbody>
        <tr>
            <td width="350">
                <p><strong>Komisi&nbsp; III</strong></p>
            </td>
            <td width="265">
                <p><strong>Komisi II</strong></p>
            </td>
        </tr>
        <tr>
            <td width="350">
                <p>Ketua</p>
            </td>
            <td width="265">
                <p>Wakil Ketua</p>
            </td>
        </tr>
        <tr>
            <td width="350">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="265">
                <p><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr>
            <td width="350">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="265">
                <p><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr>
            <td width="350">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="265">
                <p><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr>
            <td width="350">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="265">
                <p><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr>
            <td width="350">
                <p><strong><u>TOTOK&nbsp; SUGIARTO</u></strong></p>
            </td>
            <td width="265">
                <p><strong><u>M.HARDITA&nbsp; MAGDI, SH</u></strong></p>
            </td>
        </tr>
    </tbody>
</table>