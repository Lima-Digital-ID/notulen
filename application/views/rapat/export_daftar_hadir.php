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
.table-ttd tbody tr td{
    padding : 20px;
}
</style>
<body class="page">
<table style="height: 160px; width: 84%;">
    <tbody>
        <tr>    
            <td><img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Lambang_Kota_Blitar.png" alt="" width="110" height="100"/>
            <td align="center">
                <span style="font-size:18px"><strong>SEKRETARIAT DEWAN KOTA BLITAR 
                <span style="font-size:18px">JL. A. Yani No. 19 Telp. (0342) 801602</span><br>
                Situs web : http://setwan.blitarkota.go.id e-mail : setwan@blitarkota.go.id<br>
                <span style="font-size:18px"><strong>B L I T A R</strong></span>
            </td>
        </tr>
    </tbody>
</table>
    <?php 
        $getRapat = $this->db->query("select menu from menu where id_menu = '".$row_rapat->tipe."' ")->row();
    ?>
    <p style="text-align: center;"><strong>DAFTAR HADIR RAPAT <?= strtoupper($getRapat->menu) ?> </strong></p>
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
                <p><?=getDay($row_rapat->tanggal);?></p>
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
                <p><?=formatBulan($row_rapat->tanggal)?></p>
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
                <p><?=date('H:i', strtotime($row_rapat->waktu))?> &nbsp;WIB</p>
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
                <p><?=$row_rapat->tempat?></p>
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
                <?=$row_rapat->title?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table width="100%" border="1" class="table-ttd">
            <tr>
                <td width="48" align="center">
                <p><strong>NO</strong></p>
                </td>
                <td colspan="3" width="300" align="center">
                <p><strong>N A M A</strong></p>
                </td>
                <td colspan="2" width="321">
                <p><strong>TANDA TANGAN</strong></p>
                </td>
            </tr>
        <tbody>
            <?php 
            $no=0;
            foreach($anggota_rapat as $key => $row){
                $db = $this->db->query("SELECT * FROM absensi_rapat WHERE id_pegawai='$row->id_pegawai' and id_rapat = '$row_rapat->id' ")->result_array();
                $no++;
            ?>
            <tr>
                <td width="48" style="border-bottom:1px solid white" align="center">
                <p><?=$no?>.</p>
                </td>
                <td colspan="3" width="300" width="48" style="border-bottom:1px solid white" align="center">
               
                <p><?=$row->nama_pegawai?></p>
                </td>
                <?php
                if(empty($db[0])) {
                ?>
                <td width="143" width="48" style="border-bottom:1px solid white;border-right:1px solid white">
                <?= $no % 2 != 0 ? '<p>'.$no.'. _______________'.'</p>' : '' ?>
                </td>
                <td width="178" width="48" style="border-bottom:1px solid white">
                <?= $no % 2 == 0 ? '<p>'.$no.'. _______________'.'</p>' : '' ?>
                </td>
                <?php }else{ ?>
                <td width="143" width="48" style="border-bottom:1px solid white;border-right:1px solid white">
                <?= $no % 2 != 0 ? '<p>'.$no.'.'.'</p><img width="155" height="55" src="'. base_url("assets/images/".$db[0]['file']) .'"alt="">' : '' ?>
                
                </td>
                <td width="178" width="48" style="border-bottom:1px solid white">
                <?= $no % 2 == 0 ? '<p>'.$no.'.'.'</p><img width="155" height="55" src="'. base_url("assets/images/".$db[0]['file']) .'"alt="">' : '' ?>
                </td>

                <?php } ?>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
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
                    <img src="<?php echo base_url()."assets/images/upload-ttd/".$sekretaris['ttd'] ?>" alt="" width="150">
                    <p><strong><u><?php echo strtoupper($sekretaris['nama_pegawai']) ?></u></strong></p>
                    <p>NIP. <?php echo $sekretaris['nip'] ?></p>
                </td>
            </tr>
        </tbody>
    </table>

     <p><strong>&nbsp;</strong></p>
</body>
<?php 
    if(empty($_GET['word'])){
?>
<script>
window.print()
</script>
<?php } ?>