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
}
#table-pengikut tr td{
    height:100px;
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
            <p><?php echo sprintf("%03s", $this->uri->segment(3)) ?> / &nbsp;&nbsp;&nbsp;Audiensi /<?php echo bln(date('n')) ?>/ <?php echo date('Y') ?></p>
            </td>
            <td width="16">
            </td>
            <td width="214">
                <p>Kepada :</p>
            </td>
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
            <td width="88">
                <p>Lampiran</p>
            </td>
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
                <p>KOTA BLITAR</p>
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
            <p><?= $row_kunjungan->nama ?></p>
            </td>
            <td width="16">
                <p>&nbsp;</p>
            </td>
            <td width="214">
                <p>Di -</p>
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
                <?= $row_kunjungan->hasil?>
                </td>
            </tr>
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
                    <p>Blitar, <?= formatBulan(date('Y-m-d')) ?></p>
                    <p>PELAPOR</p>
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
                    <img src="<?php echo base_url()."assets/images/upload-ttd/".$pelapor->ttd ?>" alt="" width="200" height='200'>
                    <p><strong><u><?php echo strtoupper($pelapor->nama_pegawai) ?></u></strong></p>
                    <p>NIP. <?php echo $pelapor->nip ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p><b>Pengikut : </b></p>
    <table id="table-pengikut" width="100%">
        <?php 
            foreach ($anggota as $key => $value) {
                $key++;
                $cekAbsen = $this->Admin_model->getData('file','absensi','',['id_pegawai' => $value->id_pegawai,'id_kunjungan' => $this->uri->segment(3)],'')->result_array();
                $ttd = (count($cekAbsen)==0) ? "__________" : "<img src='".base_url("assets/images/".$cekAbsen[0]['file'])."' width='155'>";
        ?>
        <tr>
            <td><?= $key ?></td>
            <td width="50%"><?= $value->nama_pegawai ?></td>
            <?php if($key%2!=0){ ?>
            <td><?= $ttd ?></td>
            <td></td>
            <?php } if($key%2==0){ ?>
            <td></td>
            <td><?= $ttd ?></td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
</body>