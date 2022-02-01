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
                Situs web : http://setwan.blitarkota.go.id <br> e-mail : setwan@blitarkota.go.id<br>
                <span style="font-size:18px"><strong>B L I T A R</strong></span>
            </td>
        </tr>
    </tbody>
</table>
<br><hr>
<table>
    <tbody>
        <tr>
            <td width="88">
                <p>Nomor</p>
            </td>
            <td width="23">
                <p>:</p>
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
                <p><?= $row_rapat->title ?></p>
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
    <center><h3><strong><u>NOTULEN&nbsp; KEGIATAN</u></strong></h3></center>
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
                    <p><?=$row_rapat->dasar?></p>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>2.</p>
                </td>
                <td width="195">
                    <p>WAKTU PELAKSANAAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <p>Hari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp; <?=getDay($row_rapat->tanggal);?></p>
                    <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp; <?=formatBulan($row_rapat->tanggal)?></p>
                    <p>Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp; <?=date('H:i', strtotime($row_rapat->waktu))?> &nbsp;WIB&nbsp; s.d&nbsp;&nbsp; selesai</p>
                    <p>Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp; <?=$row_rapat->tempat?></p>
                    <p>Acara&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;<?=$row_rapat->event?></p>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>3.</p>
                </td>
                <td width="195">
                    <p>HADIR DALAM PERTEMUAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?php foreach($anggota_rapat as $row){
                    ?>
                    <p>-&nbsp; <?=$row->nama_pegawai?> <?=$row->jabatan ? '( '.$row->jabatan.' )' : ''?> </p>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>4.</p>
                </td>
                <td width="195">
                    <p>HASIL&nbsp; KEGIATAN</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?=$row_rapat->hasil_kegiatan?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <?php 
        foreach ($galery as $key => $value) {
            echo "<img src='".base_url()."assets/images/bukti_rapat/".$value->file."' width='200' height='200'>";
        }
    ?>
    <p>&nbsp;</p>
    <table width="100%">
        <tbody>
            <tr>
                <td width="60%"></td>
                <td align="center">
                    <p>Notulis Kegiatan</p>
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
                    <img src="<?php echo base_url()."assets/images/upload-ttd/".$sekretaris['ttd'] ?>" alt="" width="200" height='200'>
                    <p><strong><u><?php echo strtoupper($sekretaris['nama_pegawai']) ?></u></strong></p>
                    <p>NIP. <?php echo $sekretaris['nip'] ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <?php 
        if(!empty($this->uri->segment(4)) && $this->uri->segment(4)=='false'){
    ?>
    <script>
        window.print()
    </script>    
    <?php
        }
    ?>
</body>