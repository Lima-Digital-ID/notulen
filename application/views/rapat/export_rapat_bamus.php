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
}

.bordered th, .bordered td {
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
@media print{
    .galery{
        page-break-before : always;   
    }
}
ul,ol{
    padding-left:15px;
}
</style>
<body class="page">
    <center><h3><strong><u>NOTULEN&nbsp; KEGIATAN</u></strong></h3></center>
    <table width="100%" class="table bordered" border="1">
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
                    <table>
                        <tr>
                            <td>Hari</td>
                            <td>:</td>
                            <td><?=getDay($row_rapat->tanggal);?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?=formatBulan($row_rapat->tanggal)?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td><?=date('H:i', strtotime($row_rapat->waktu))?> &nbsp;WIB&nbsp; s.d&nbsp;&nbsp; selesai</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td><?=$row_rapat->tempat?></td>
                        </tr>
                        <tr>
                            <td>Acara</td>
                            <td>:</td>
                            <td><?=$row_rapat->title?></td>
                        </tr>
                        <tr>
                            <td>Materi</td>
                            <td>:</td>
                            <td><?=$row_rapat->acara?></td>
                        </tr>
                    </table>
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
                    <?php 
                        foreach ($tipe_pegawai as $key => $value) {
                            $this->db->select('nama_pegawai');
                            $this->db->join("tbl_pegawai tp","ar.id_pegawai=tp.id_pegawai");
                            $anggota_rapat = $this->db->get_where("absensi_rapat ar",['ar.id_rapat' => $id_rapat,'tp.tipe' => $value->id_tipe]);
                            $row = $anggota_rapat->num_rows();
                            if($row!=0){
                                echo "<p style='margin-bottom:5px'>".$value->tipe."</p>";
                                
                                $anggota_rapat =  $anggota_rapat->result();
                                foreach ($anggota_rapat as $i => $v) {
                                    echo "<span style='margin-left:10px'>- ".$v->nama_pegawai."</span><br>";
                                }
                                echo "<br>";
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>3.</p>
                </td>
                <td width="195">
                    <p>IJIN TIDAK HADIR</p>
                </td>
                <td width="19">
                    <p>:</p>
                </td>
                <td width="454">
                    <?php 
                        $query = $this->db->query("SELECT nama_pegawai FROM anggota_rapat ar join tbl_pegawai tp on ar.id_pegawai = tp.id_pegawai WHERE id_rapat = '$id_rapat' AND ar.id_pegawai NOT IN (SELECT id_pegawai FROM absensi_rapat WHERE id_rapat = '$id_rapat');")->result();

                        foreach ($query as $key => $value) {
                            echo "<p style='margin-left:10px'>- ".$value->nama_pegawai."</p>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="39">
                    <p>5.</p>
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
    <p>&nbsp;</p>
    <table width="100%">
        <tbody>
            <tr>
                <td width="60%"></td>
                <td align="center">
                    <p>Sekertaris DPRD Kota Blitar</p>
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
                <?php
                    if($sekretarisRow=!0){
                ?>
                    <img src="<?php echo base_url()."assets/images/upload-ttd/".$sekretaris->ttd ?>" alt="" width="150">
                    <p><strong><u><?php echo strtoupper($sekretaris->nama_pegawai) ?></u></strong></p>
                    <p>NIP. <?php echo $sekretaris->nip ?></p>
                <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <div class="galery">
    <?php 
        foreach ($galery as $key => $value) {
            echo "<img style='margin-left:10px' src='".base_url()."assets/images/bukti_rapat/".$value->file."' width='200' height='200'>";
        }
    ?>
    </div>
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