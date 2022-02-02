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
    <p><strong>&nbsp;</strong></p>
    <p style="text-align: center;"><strong>DAFTAR HADIR KUNJUNGAN <?= strtoupper($row_kunjungan->nama) ?>&nbsp; </strong></p>
    <table width="728">
        <tbody>
            <tr>
                <td colspan="3" width="75">
                <p>Hari</p>
                </td>
                <td width="28">
                <p>:</p>
                </td>
                <td colspan="4" width="625">
                <p><?=getDay($row_kunjungan->awal_waktu_pelaksanaan);?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="75">
                <p>Tanggal</p>
                </td>
                <td width="28">
                <p>:</p>
                </td>
                <td colspan="4" width="625">
                <p> <?=formatDate($row_kunjungan->awal_waktu_pelaksanaan)?> s/d <?=formatDate($row_kunjungan->ahir_waktu_pelaksanaan)?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="75">
                <p>Pukul</p>
                </td>
                <td width="28">
                <p>:</p>
                </td>
                <td colspan="4" width="625">
                <p><?=date('H:i', strtotime($row_kunjungan->waktu))?> &nbsp;WIB</p>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="75">
                <p>Tempat</p>
                </td>
                <td width="28">
                <p>:</p>
                </td>
                <td colspan="4" width="625">
                <?php $db = $this->db->query("SELECT * FROM sub_tipe_kunjungan WHERE id='$row_kunjungan->id_sub_tipe_kunjungan'")->row_array(); ?>
                <p><?=$db['nama'];?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="75">
                <p>Acara</p>
                </td>
                <td width="28">
                <p>:</p>
                </td>
                <td colspan="4" width="625">
                <?=$row_kunjungan->nama?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table width="100%" class="table" border="1">
        <tbody>
            <tr>
                <td width="10%" align="center">
                <p><strong>NO</strong></p>
                </td>
                <td width="50%" align="center">
                <p><strong>N A M A</strong></p>
                </td>
                
                <td colspan="2" width="40%">
                <p><strong>TANDA TANGAN</strong></p>
                </td>
            </tr>
            <?php
                $no=0;
                foreach($anggota_kunjungan as $row){ ?>
                <?php 

                $db = $this->db->query("SELECT * FROM absensi WHERE id_pegawai='$row->id_pegawai' and id_kunjungan = '$row_kunjungan->id' ")->row_array();
                $no++; 
            ?>
            <tr>
                <td width="48" style="border-bottom:1px solid white" align="center">
                <p><?=$no?>.</p>
                </td>
                <td width="300" width="48" style="border-bottom:1px solid white" align="center">
               
                <p><?=$row->nama_pegawai?></p>
                </td>
                <?php
                if(empty($db['id'])) {
                ?>
                <td width="143" width="48" style="border-bottom:1px solid white;border-right:1px solid white">
                <?= $no % 2 != 0 ? '<p>'.$no.'. _______________'.'</p>' : '' ?>
                </td>
                <td width="178" width="48" style="border-bottom:1px solid white">
                <?= $no % 2 == 0 ? '<p>'.$no.'. _______________'.'</p>' : '' ?>
                </td>
                <?php }else{ ?>
                <td width="143" width="48" style="border-bottom:1px solid white;border-right:1px solid white">
                <?= $no % 2 != 0 ? '<p>'.$no.'.'.'</p><img width="155" height="55" src="'. base_url("assets/images/".$db['file']) .'"alt="">' : '' ?>
                
                </td>
                <td width="178" width="48" style="border-bottom:1px solid white">
                <?= $no % 2 == 0 ? '<p>'.$no.'.'.'</p><img width="155" height="55" src="'. base_url("assets/images/".$db['file']) .'"alt="">' : '' ?>
                </td>

                <?php } ?>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <p>&nbsp;</p>
<!--     <table width="100%">
    <tbody>
    <tr>
            <td width="397" align="center">
                Mengetahui
            </td>
            <td width="321" align="center">
            </td>
        </tr>
        <tr>
            <td width="397" align="center">
                <p>DEWAN PERWAKILAN RAKYAT DAERAH</p>
                <p>KOTA BLITAR</p>
                <p>Ketua</p>
                <br><br><br><br>
                <p><strong><u>dr. SYAHRUL &nbsp;ALIM</u></strong></p>
            </td>
            <td width="321" align="center">
                <p>SEKRETARIS DPRD KOTA BLITAR</p>
                <br><br><br><br><br><br><br><br>
                <strong><u>Dra. EKA ATIKAH</u></strong><br>
                Pembina Utama Muda <br>
                NIP. 19680812 198803 2 006
            </td>
        </tr>
    </tbody>
    </table>
 -->
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
                    <img src="<?php echo base_url()."assets/images/upload-ttd/".$sekretaris['ttd'] ?>" alt="" width="150">
                    <p><strong><u><?php echo strtoupper($sekretaris['nama_pegawai']) ?></u></strong></p>
                    <p>NIP. <?php echo $sekretaris['nip'] ?></p>
                </td>
            </tr>
        </tbody>
    </table>

     <p><strong>&nbsp;</strong></p>
</body>