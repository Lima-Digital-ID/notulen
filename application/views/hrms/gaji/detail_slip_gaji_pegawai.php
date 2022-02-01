<?php
function formatCurrency($val){
    return number_format($val, 0, '.', '.');
}
function formatTanggal($val){
    $date=date('d-m-Y', strtotime($val));
    return $date;
}
function getMonth($month){
    $month=explode('-', $month);
    $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return $bulan[$month[1]-1].' '.$month[0];
}
?>
<section role="main" class="content-body pb-0">
    <header class="page-header">
        <h2><?=$title?></h2>
    
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?=base_url('welcome')?>">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span><?=$title?></span></li>
            </ol>
            <a style="margin-left:10px"></a>
            <!-- <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a> -->
        </div>
    </header>
    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured mb-4">
                <div class="card-body">
                    <div style="padding-bottom: 10px;">
                        <div class="form-inline">
                            <div class="col-sm-6">
                                <div class="row">
                                <form action="<?=site_url('hrms/gaji/cetak_slip')?>" method="post" target="_blank">
                                    <input type="hidden" value="<?=($gaji != null ? $gaji->id_pegawai : '')?>" name="id_pegawai">
                                    <?php
                                    if (isset($_POST['bulan'])) {
                                        
                                    ?>
                                    <input type="hidden" value="<?=$_POST['bulan']?>" name="bulan">
                                    <input type="hidden" value="<?=$_POST['tahun']?>" name="tahun">
                                    <?php
                                    }else{
                                    ?>
                                    <input type="hidden" value="<?=date('m')?>" name="bulan">
                                    <input type="hidden" value="<?=date('Y')?>" name="tahun">
                                    <?php
                                    }
                                    ?>
                                    <button class="btn btn-info btn-sm"><i class="fa fa-wpforms"></i>Cetak Slip Gaji</button>
                                <?php 
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
                                </form>
                                &nbsp;
                                <form action="<?=base_url('hrms/gaji/jurnal_gaji')?>" method="post">
                                    <input type="hidden" value="<?=($gaji->tipe_gaji == 1 ? $komisi_langsung : $komisiperkepala)?>" name="komisi">
                                    <input type="hidden" value="<?=$grand_total?>" name="total_gaji">
                                    <input type="hidden" value="<?=$bulan?>" name="bulan">
                                    <input type="hidden" value="<?=$gaji->nama_pegawai?>" name="nama_pegawai">
                                    <input type="hidden" value="<?=$gaji->location_id?>" name="location_id">
                                    <!-- <button class="btn btn-success btn-sm" type="submit" <?=($cek_complete_gaji == 0 ? "" : "disabled")?>><i class="fa fa-check"></i> Tandai sudah digaji</button> -->
                                </form>
                                </div>
                            </div>
                            <div class="col-sm-6" align="right">
                                <div class="row">
                                    <form accept="<?=current_url()?>" method="post" class="form-inline">
                                        <label>Tampilkan Gaji : </label>&nbsp;
                                        <select class="form-control" data-plugin-selectTwo name="bulan" required>
                                            <option value="">--Pilih Bulan--</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>&nbsp;
                                        <select data-plugin-selectTwo class="form-control" name="tahun" required>
                                            <option value="">--Pilih Tahun--</option>
                                            <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++) { 
                                            ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>&nbsp;
                                        <button class="btn btn-success"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-4">
                            <div class="row">
                                <table>
                                <tr>
                                    <td>Bulan</td>
                                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                    <td><?=getMonth($bulan)?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pegawai</td>
                                    <td> &nbsp;&nbsp;: &nbsp;&nbsp;</td>
                                    <td><?=$gaji != null ? $gaji->nama_pegawai : 0?></td>
                                </tr>
                                <tr>
                                    <td>Tipe Gaji</td>
                                    <td> &nbsp;&nbsp;: &nbsp;&nbsp;</td>
                                    <td><?=$tipe_gaji?></td>
                                </tr>
                                </table>
                                <br>
                            </div>
                        </div>
                        <br>
                        <?php
                            if ($tipe_gaji == 1) {
                        ?>
                        <div class="col-sm-8">
                            <div class="row">
                                <form action="<?=site_url('hrms/gaji/inputPotongan')?>" method="post" class="form-inline">
                                    <!-- <label>Input Komisi : </label>&nbsp; -->
                                    <!-- <input class="form-control" name="potongan" id="jml_potongan" placeholder="Potongan Bpjs"  onkeyup="cekPotongan(this)">
                                    <input class="form-control" name="cicilan" id="jml_cicilan" placeholder="Cicilan"  onkeyup="cekCicilan(this)">
                                    <input class="form-control" name="kasbon" id="jml_kasbon" placeholder="Kasbon"  onkeyup="cekKasbon(this)"> -->
                                    <input class="form-control" name="komisi" id="komisi" placeholder="Komisi Langsung"  onkeyup="cekKomisi(this)">&nbsp;&nbsp;
                                    <input class="form-control" type="hidden" name="id_pegawai" value="<?=$gaji != null ? $gaji->id_pegawai : 0?>">
                                    <input class="form-control" type="hidden" name="bulan" value="<?=$bulan?>">
                                    <button class="btn btn-success">Input</button>
                                    <br>
                                </form>
                            </div>
                        </div>
                        <br>
                        <?php
                            }
                        ?>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th class="text-right">Fee</th>
                                    <th class="text-center">Kehadiran</th>
                                    <th class="text-right">sub total</th>
                                </tr>
                                <tr>
                                    <th>Gaji Pokok</th>
                                    <td class="text-right">Rp. <?=formatCurrency($gaji->gaji_pokok)?></td>
                                    <td colspan="2" class="text-right">Rp. <?=formatCurrency($gaji->gaji_pokok)?></td>
                                </tr>
                               <tr>
                                    <th>Total</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"><?=$kehadiran?></td>
                                    <td class="text-right"></td>
                                </tr>
                                <tr>
                                    <th>Uang Lembur</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">Rp. <?=formatCurrency($uang_lembur)?></td>
                                </tr>
                                <?php
                                    if ($tipe_gaji == 1) {
                                ?>
                                <tr>
                                    <th>Komisi Langsung</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">Rp. <?=formatCurrency($komisi_langsung)?></td>
                                </tr>
                                <?php
                                    }

                                    if ($tipe_gaji == 2) {
                                ?>
                                <tr>
                                    <th>Komisi Minimal Kepala</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"><?=$totalpotong?> x potong</td>
                                    <td class="text-right">Rp. <?=formatCurrency($komisiperkepala)?></td>
                                </tr>
                                <?php
                                    }
                                    if ($tipe_gaji == 3) {
                                ?>
                                <tr>
                                    <th>Komisi Bertingkat</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"><?=$totalpotong?> x potong</td>
                                    <td class="text-right">Rp. <?=formatCurrency($komisiperkepala)?></td>
                                </tr>
                                <?php
                                    }
                                    if ($tipe_gaji == 4) {
                                ?>
                                <tr>
                                    <th>Komisi per Transaksi</th>
                                    <td class="text-right">Rp. <?=formatCurrency($kom_trx)?></td>
                                    <td class="text-center"><?=$totalpotong?> x transaksi</td>
                                    <td class="text-right">Rp. <?=formatCurrency($komisiperkepala)?></td>
                                </tr>
                                <?php
                                    }
                                    if ($gaji->bonus_kerajinan != 0) {
                                ?>
                                <tr>
                                    <th>Bonus Kerajinan</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">Rp. <?=formatCurrency($bonus_kerajinan)?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <th colspan="2" class="text-center">Sub Total</th>
                                    <th colspan="2" class="text-right"><?=formatCurrency($hitung_gaji). ($hitung_gaji < $real_gaji ? ' < '.formatCurrency($real_gaji). '(Minimum Gaji)' : '')?></th>
                                </tr>
                                <tr>
                                    <th>Denda</th>
                                    <td class="text-right"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">- Rp. <?=formatCurrency($jumlah_denda)?></td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">Total</th>
                                    <th class="text-right">Rp. <?=formatCurrency($grand_total)?></th>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="title" style="color:black">Detail Denda</h4>
                                <table class="table table-bordered table-striped" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Alasan</th>
                                            <th class="text-center">Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($detail as $key => $value) {
                                            // if ($value['denda'] > 0) {
                                        ?>
                                        <tr>
                                            <td><?=formatTanggal($value['tanggal'])?></td>
                                            <td><?=$value['alasan_denda']?></td>
                                            <td class="text-right">Rp. <?=formatCurrency($value['denda'])?></td>
                                        </tr>
                                        <?php
                                            // }
                                        }
                                        ?>
                                        <tr>
                                            <th class="text-center" colspan="2">Total Denda</th>
                                            <th class="text-right">Rp. <?=formatCurrency($jumlah_denda)?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php if ($gaji->tipe_gaji == 2 || $gaji->tipe_gaji == 3 || $gaji->tipe_gaji == 4) {
                                $tipe_gaji=$gaji->tipe_gaji;
                            ?>
                            <div class="col-sm-6">
                                <h4 class="title" style="color:black">Detail Komisi</h4>
                                <table class="table table-bordered table-striped" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Jasa</th>
                                            <th>Total</th>
                                            <th>Komisi</th>
                                            <th class="text-center">Total</th>
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
                                            <td class="text-right">Rp. <?=formatCurrency($komisi)?></td>
                                            <td class="text-right">Rp. <?=formatCurrency($komisi * $value->quantity)?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th class="text-center" colspan="5">Total Komisi</th>
                                            <th class="text-right">Rp. <?=formatCurrency($komisiperkepala)?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

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
    var kom_min="<?=$komisiperkepala?>";
    var kom_level="<?=$kom_level?>";
    // var grand="<?=$grand_total?>";
</script>