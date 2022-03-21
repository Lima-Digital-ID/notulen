<?php
function getDay($date)
{
    $day = date('w', strtotime($date));
    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    return $days[$day];
}
function formatDate($date)
{
    $day = date('d-m-Y', strtotime($date));
    return $day;
}
function formatBulan($date)
{
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $date = explode('-', $date);
    $getMonth = $date[1];
    return $date[2] . ' ' . $bulan[$getMonth - 1] . ' ' . $date[0];
}
$tanggal = formatBulan($row_rapat->tanggal);
$explode_tanggal = explode(' ', $tanggal);
?>
<style>
    table td,
    table td * {
        vertical-align: top;
    }
</style>
<p>
<center>
<strong><img style="display: block; margin-left: auto; margin-right: auto;" src="https://upload.wikimedia.org/wikipedia/commons/5/55/Lambang_Kota_Blitar.png" alt="" width="150" height="200" />&nbsp;</strong>
</center>
</p>
<p><strong>&nbsp;</strong></p>
<p>&nbsp;</p>
<p style="text-align: center;"><strong>RAPAT PARIPURNA &nbsp;&nbsp;&nbsp;</strong></p>
<p style="text-align: center;"><strong>DEWAN PERWAKILAN RAKYAT DAERAH</strong></p>
<p style="text-align: center;"><strong>KOTA BLITAR</strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;text-transform: uppercase;"><strong><?= $row_rapat->title ?> </strong></p>
<p style="text-align: center;"><strong>KOTA BLITAR TA 2020</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<h4 style="text-align: center;"><em>Blitar, <?= $explode_tanggal[0] ?></em> <em><?= $explode_tanggal[1] ?> </em><em><?= $explode_tanggal[2] ?></em></h4>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
    <!-- pagebreak -->
</p>
<p style="text-align: center;"><strong>&nbsp;DEWAN PERWAKILAN RAKYAT DAERAH </strong></p>
<p style="text-align: center;"><strong>KOTA BLITAR</strong></p>
<p>&nbsp;</p>
<table>
    <tbody>
        <tr>
            <td width="104">
                <p>&nbsp;NOTULEN</p>
            </td>
            <td width="19">
                <p><strong>:</strong></p>
            </td>
            <td width="501">
                <p><strong>RA</strong> <strong>PAT PARIPURNA DPRD KOTA BLITAR </strong><strong>:</strong></p>
                <p style="text-transform: uppercase;"><strong><?= $row_rapat->title ?></strong></p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<table width="651">
    <tbody>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="142">
                <p>H a r i</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p style="text-transform: uppercase;"><?= getDay($row_rapat->tanggal); ?></p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="142">
                <p>Tanggal</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p><?= formatBulan($row_rapat->tanggal) ?></p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="142">
                <p>J a m</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p><?= date('H:i', strtotime($row_rapat->waktu)) ?> &nbsp;WIB</p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="142">
                <p>Tempat</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p><?= $row_rapat->tempat ?></p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>I.</p>
            </td>
            <td colspan="2" width="142">
                <p>Jenis Rapat</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p>Rapat Paripurna</p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>II.</p>
            </td>
            <td colspan="2" width="142">
                <p>Sifat Rapat</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p><?= $row_rapat->sifat == 1 ? 'Terbuka' : 'Tertutup' ?></p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>III.</p>
            </td>
            <td colspan="2" width="142">
                <p>Acara Rapat</p>
            </td>
            <td width="28">
                <p>&nbsp;</p>
            </td>
            <td colspan="4" width="436">
                <?= $row_rapat->acara ?>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>IV.</p>
            </td>
            <td colspan="2" width="142">
                <p>Pimpinan Rapat</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p><?=$row_rapat->ketua?></p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="142">
                <p>Sekretaris</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p><?=$row_rapat->sekretaris?></p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>V.</p>
            </td>
            <td colspan="2" width="142">
                <p>Jumlah Anggota</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="4" width="436">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php 
        $index=$total=0;
        $total_group=count($group_anggota);
        foreach($group_anggota as $key => $row){
            $index++;
            $total+=count($row->detail);
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td width="38">
                <p><?=$index?>.</p>
            </td>
            <td colspan="3" width="302">
                <p>F. <?=$row->nama_fraksi?></p>
            </td>
            <td width="19">
                <p>:</p>
            </td>
            <td width="236">
                <p>&nbsp;&nbsp;&nbsp; <?=$key == ($total_group - 1) ? '<u>' : ''?>&nbsp;&nbsp;<?=count($row->detail)?> orang<?=$key == ($total_group - 1) ? '</u>' : ''?></p>
            </td>
            <td width="11">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="4" width="340">
                <p>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J u m l a h</p>
            </td>
            <td width="19">
                <p>:</p>
            </td>
            <td width="236">
                <p>&nbsp;&nbsp;&nbsp; <?=$total?> orang</p>
            </td>
            <td width="11">
                <p>&nbsp;</p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<table width="691">
    <tbody>
        <tr>
            <td width="45">
                <p>VI.</p>
            </td>
            <td colspan="6" width="166">
                <p>Anggota yang hadir</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="14" width="452">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php 
        $hadir=array();
        $index=$total=0;
        foreach($group_anggota as $key => $row){
            $index++;
            $absen=0;
            foreach($row->detail as $value){
                $absen+=($value->status == 1 ? 1 : 0);
                if($value->status == 1){
                    $hadir[]=(object)$value;
                }
            }
            $total+=$absen;
        ?>

        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td width="38">
                <p><?=$index?>.</p>
            </td>
            <td colspan="8" width="301">
                <p>F. <?=$row->nama_fraksi?></p>
            </td>
            <td colspan="3" width="16">
                <p>:</p>
            </td>
            <td colspan="3" width="222">
                <p>&nbsp;&nbsp;&nbsp; <?=$key == ($total_group - 1) ? '<u>' : ''?>&nbsp;&nbsp;<?=$absen?> orang<?=$key == ($total_group - 1) ? '</u>' : ''?></p>
            </td>
            <td colspan="6" width="69">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php
        }
        $pembatas=$total/2;
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td width="38">
                <p>&nbsp;</p>
            </td>
            <td colspan="8" width="301">
                <p>J u m l a h</p>
            </td>
            <td colspan="3" width="16">
                <p>:</p>
            </td>
            <td colspan="3" width="222">
                <p>&nbsp;&nbsp;&nbsp; <?=$total?> orang</p>
                <p>&nbsp;</p>
            </td>
            <td colspan="6" width="69">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php 
        $bagi1=0;
        $bagi2=ceil($pembatas);
        for($i=0; $i < ceil($pembatas); $i++){
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="66">
                <p><?=$i == 0 ? 'Yaitu : ' : ''?></p>
            </td>
            <td colspan="2" width="38">
                <p><?=($first=$bagi1 + 1)?></p>
            </td>
            <td colspan="6" width="236">
                <p><?=$hadir[$bagi1]->nama_pegawai?></p>
            </td>
            <td colspan="3" width="40">
                <p><?=(!empty($hadir[$bagi2]) ? $sec=$bagi2 + 1 : '')?></p>
            </td>
            <td colspan="3" width="234">
                <p><?=!empty($hadir[$bagi2]) ?  $hadir[$bagi2]->nama_pegawai : ''?></p>
            </td>
            <td colspan="5" width="32">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php
        $bagi1++;
        $bagi2++;
        }
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="66">
                <p>&nbsp;</p>
            </td>
            <td colspan="3" width="42">
                <p>&nbsp;</p>
            </td>
            <td colspan="6" width="236">
                <p>&nbsp;</p>
            </td>
            <td colspan="3" width="40">
                <p>&nbsp;</p>
            </td>
            <td colspan="3" width="234">
                <p>&nbsp;</p>
            </td>
            <td colspan="4" width="28">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="45">
                <p>VII.</p>
            </td>
            <td colspan="9" width="339">
                <p>Anggota yang tidak hadir :</p>
            </td>
            <td colspan="3" width="16">
                <p>&nbsp;</p>
            </td>
            <td colspan="6" width="265">
                <p>&nbsp;</p>
            </td>
            <td colspan="3" width="27">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php 
        $tdk_hadir=array();
        $index=$total=0;
        foreach($group_anggota as $key => $row){
            $index++;
            $absen=0;
            foreach($row->detail as $value){
                $absen+=($value->status == 0 ? 1 : 0);
                if($value->status == 0){
                    $tdk_hadir[]=(object)$value;
                }
            }
            $total+=$absen;
        ?>

        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td width="38">
                <p><?=$index?>.</p>
            </td>
            <td colspan="8" width="301">
                <p>F. <?=$row->nama_fraksi?></p>
            </td>
            <td colspan="3" width="16">
                <p>:</p>
            </td>
            <td colspan="3" width="222">
                <p>&nbsp;&nbsp;&nbsp; <?=$key == ($total_group - 1) ? '<u>' : ''?>&nbsp;&nbsp;<?=$absen?> orang<?=$key == ($total_group - 1) ? '</u>' : ''?></p>
            </td>
            <td colspan="6" width="69">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td width="38">
                <p>&nbsp;</p>
            </td>
            <td colspan="8" width="301">
                <p>J u m l a h</p>
            </td>
            <td colspan="3" width="16">
                <p>:</p>
            </td>
            <td colspan="6" width="265">
                <p>&nbsp;&nbsp;&nbsp; &nbsp;<?=$total?> orang</p>
            </td>
            <td colspan="3" width="27">
                <p>&nbsp;</p>
            </td>
        </tr>
        
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="66">
                <p>Yaitu</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="17" width="546">
                <p>&nbsp;</p>
            </td>
            <td width="6">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php 
        $tdk_hadir=array();
        $index=$total=0;
        foreach($tdk_hadir as $row){
            $index++;
        ?>
        <tr>
            <td width="45">
                <p>&nbsp;</p>
            </td>
            <td width="38">
                <p><?=$index?>.&nbsp; &nbsp;</p>
            </td>
            <td colspan="7" width="292">
                <p><?=$row->nama_pegawai?></p>
            </td>
            <td colspan="11" width="306">
                <p><?=$row->keterangan?></p>
            </td>
            <td colspan="2" width="10">
                <p>&nbsp;</p>
            </td>
        </tr>
        <?php
        }
        ?>
        
        <tr>
            <td width="45">&nbsp;</td>
            <td width="38">&nbsp;</td>
            <td width="28">&nbsp;</td>
            <td width="28">&nbsp;</td>
            <td width="10">&nbsp;</td>
            <td width="4">&nbsp;</td>
            <td width="58">&nbsp;</td>
            <td width="28">&nbsp;</td>
            <td width="135">&nbsp;</td>
            <td width="9">&nbsp;</td>
            <td width="2">&nbsp;</td>
            <td width="5">&nbsp;</td>
            <td width="12">&nbsp;</td>
            <td width="25">&nbsp;</td>
            <td width="4">&nbsp;</td>
            <td width="192">&nbsp;</td>
            <td width="37">&nbsp;</td>
            <td width="4">&nbsp;</td>
            <td width="1">&nbsp;</td>
            <td width="17">&nbsp;</td>
            <td width="4">&nbsp;</td>
            <td width="6">&nbsp;</td>
        </tr>
        <tr>
            <td width="45">
                <p>VIII.</p>
            </td>
            <td colspan="6" width="166">
                <p>Undangan</p>
            </td>
            <td width="28">
                <p>:</p>
            </td>
            <td colspan="14" width="452">
                <p><?=$row_rapat->undangan?></p>
            </td>
        </tr>
    </tbody>
</table>
<p>XI. Jalannya Rapat</p>
<?=$row_rapat->isi_risalah?>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>DEWAN PERWAKILAN RAKYAT DAERAH</strong></p>
<p><strong>KOTA BLITAR</strong></p>
<p><strong>&nbsp;</strong></p>
<table width="679">
    <tbody>
        <tr>
            <td width="340">
                <p><strong>KETUA DPRD, </strong></p>
            </td>
            <td width="340">
                <p><strong>SEKRETARIS,</strong></p>
            </td>
        </tr>
        <tr>
            <td width="340">
                <p><strong>&nbsp;</strong></p>
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="340">
                <p><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr>
            <td width="340">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="340">
                <p><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr>
            <td width="340">
                <p><strong><u>dr. Syahrul Alim</u></strong></p>
            </td>
            <td width="340">
                <p><strong><u>Dra. EKA ATIKAH</u></strong></p>
            </td>
        </tr>
        <tr>
            <td width="340">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="340">
                <p>Pembina Utama Muda</p>
            </td>
        </tr>
        <tr>
            <td width="340">
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="340">
                <p>NIP. 19680812 198803 2 006</p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>