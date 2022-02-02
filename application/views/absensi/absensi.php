<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">

        </div>
    </div>
</div>
<style>
    #my_camera {
        width: 320px;
        height: 240px;
        border: 1px solid black;
    }
    .sigWrapper.current{
        border-color : transparent;
    }
    #modalAddRapat2 .modal-header{
        border-bottom-color : transparent;
    }
    #modalAddRapat2 .modal-footer{
        border-top-color : transparent;
    }
</style>
<?php
function formatTime($time)
{
    $jam = strtotime($time);
    return date('H:i', $jam);
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?= $title ?></div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="data_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Kunjungan / Rapat</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Jenis Kunjungan / Rapat</th>
                                    <th class="text-center">Kunjungan ke / Tempat Rapat</th>
                                    <th class="text-center" width="200px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$db = $this->db->query("SELECT * FROM kunjungan")->result();
foreach ($db as $a) : ?>
    <div id="daftar<?= $a->id ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Daftar Peserta : <?= $a->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <?php
                    $getTipe = $this->Admin_model->getData('tipe','tipe_pegawai','',['id_tipe' => $_GET['id_tipe']],'')->result_array()[0];
                    ?>

                    <p><?= $getTipe['tipe'] ?> :</p>
                    <?php
                    $getAnggota = $this->Admin_model->getData('tp.nama_pegawai,tp.id_pegawai,ak.id','anggota_kunjungan ak',['tbl_pegawai tp','ak.id_pegawai = tp.id_pegawai'],['ak.id_kunjungan' => $a->id,'tp.tipe' => $_GET['id_tipe']],'')->result_array();

                    foreach($getAnggota as $anggota){
                    ?>
                    <div class="row detail-field mb-3">
                        <div class="col-md-8">
                            <h4 class="form-control"><?= $anggota['nama_pegawai'] ?></h4>
                        </div>
                        <div class="col-md-4" style="margin-top: -5px;" >
                        <?php
                        $absen = $this->db->query("SELECT * FROM absensi WHERE id_pegawai='$anggota[id_pegawai]' AND id_kunjungan='$a->id'")->result();
                        if ($absen == null ) { ?>
                            <!-- <button type="button" class="btn btn-primary btn-xs" data-target="#modalAddForkopimda" data-id="<?= $value->id ?>" onclick="setCameranLocation(this)" data-toggle="modal" style="margin-top:5px">Absen</button> -->
                            <button type="button" class="btn btn-primary mt-2" data-target="#modalAddForkopimda2" data-id="<?= $anggota['id'] ?>" onclick="setCameranLocation(this)" data-toggle="modal" style="margin-top:5px">Absen</button>
                        <?php } else { ?>
                          <p class="btn btn-success mt-2">Sudah Absen</p> 
                        <?php } ?>
                           
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
 <div id="modalAddForkopimda2" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Forkopimda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="<?= base_url('absensi/upload') ?>" method="post" id="form_absen">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" name="id_tipe" value="<?= $_GET['id_tipe'] ?>">

                    <div class="signature-area" id="signature-area">
                        <h2 class="title-area">Put signature,</h2>
                        <div class="sig sigWrapper" style="height:auto;">
                            <div class="typed"></div>
                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                        </div>
                    </div>
                    <input type="button" class="btn-save" value="ok" onClick="take_snapshot2()" />
                    <input type="button" class="btn-clear" value="clear" onclick="take_clear()" />
                    <div id="results2"></div>
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="file_absen" id="file_absen">

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="checkSubmited()" class="btn btn-success waves-effect">Simpan</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$db = $this->db->query("SELECT * FROM rapat")->result();
foreach ($db as $a) : ?>
    <div id="daftarRapat<?= $a->id ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Daftar Peserta : <?= $a->title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <?php 
                        $getTipe = $this->Admin_model->getData('tipe','tipe_pegawai','',['id_tipe' => $_GET['id_tipe']],'')->result_array()[0];
                    ?>
                        <p><?= $getTipe['tipe'] ?>:</p>
                        <?php $db = $this->db->query("SELECT ar.id, ar.id_rapat, ar.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ar.status, ar.jabatan FROM anggota_rapat as ar JOIN tbl_pegawai as tp ON tp.id_pegawai=ar.id_pegawai WHERE id_rapat='$a->id' and tp.tipe = '$_GET[id_tipe]' ")->result(); ?>
                        <?php foreach($db as $row){?>
                    <div class="row detail-field mb-3">
                        <div class="col-md-8">
                            <h4 class="form-control" style="height:auto"><?=$row->nama_pegawai?></h4>
                        </div>
                        <div class="col-md-4" style="margin-top: -5px;" >
                            <?php
                            $absen = $this->db->query("SELECT * FROM absensi_rapat WHERE id_pegawai='$row->id_pegawai' and id_rapat = '$a->id' ")->result();
                        if ($absen == null ) { ?>
                            <button type="button" class="btn btn-primary mt-2" data-target="#modalAddRapat2" data-id="<?= $row->id ?>" onclick="setCameranLocation2(this)" data-toggle="modal" style="margin-top:5px">Absen</button>
                        <?php } else { ?>
                          <p class="btn btn-success mt-2">Sudah Absen</p> 
                        <?php } ?>  
                        </div>
                    </div>
                    <?php 
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<div id="modalAddRapat2" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Forkopimda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="<?= base_url('absensi/uploadrapat') ?>" method="post" id="form_absen2">
                <div class="modal-body">
                <input type="hidden" id="id2" name="id2">
                <input type="hidden" name="id_tipe" value="<?= $_GET['id_tipe'] ?>">
                    <div class="signature-area" id="signature-area2">
                        <h2 class="title-area">Put signature,</h2>
                        <div class="sig sigWrapper" style="height:auto;">
                            <div class="typed"></div>
                            <canvas class="sign-pad" id="sign-pad2" width="300" height="100"></canvas>
                        </div>
                    </div>
                    <input type="button" class="btn-save" value="ok" onClick="take_snapshot3()" />
                    <input type="button" class="btn-clear" value="clear" onclick="take_clear2()" />
                    <div id="results3"></div>
                    <input type="hidden" name="longitude" id="longitude2">
                    <input type="hidden" name="latitude" id="latitude2">
                    <input type="hidden" name="file_absen" id="file_absen2">

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="checkSubmited2()" class="btn btn-success waves-effect">Simpan</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url('assets/') ?>js/webcam/webcam.min.js"></script>
<script src="<?= base_url('assets/') ?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        <?php 
            if(isset($_GET['showModal'])){    
            $modal = isset($_GET['idRapat']) ? "#daftarRapat".$_GET['idRapat'] : '#daftar'.$_GET['idKunjungan'];
        ?>
        $("<?= $modal?>").modal('show')
        <?php } ?>
        $('#signature-area').signaturePad({
            drawOnly: true,
            drawBezierCurves: true,
            lineTop: 90
        });

        $('#signature-area2').signaturePad({
            drawOnly: true,
            drawBezierCurves: true,
            lineTop: 90
        });

    });

    function take_clear() {
        $(".btn-clear").click(function(e) {
            $('#signature-area').signaturePad().clearCanvas();
        });
    }
    function take_clear2() {
        $(".btn-clear").click(function(e) {
            $('#signature-area2').signaturePad().clearCanvas();
        });
    }

    function take_snapshot2() {
        html2canvas([document.getElementById('sign-pad')], {
            onrendered: function(canvas) {
                var canvas_data = canvas.toDataURL('image/jpeg');
                var img_data = canvas_data.replace(/^data:image\/(png|jpg);base64,/, "");
                document.getElementById('results2').innerHTML =
                    '<img id="imageprev2" src="' + canvas_data + '" alt="' + img_data + '"/>';

                var base64image = document.getElementById("imageprev2").src;

                $('#file_absen').val(base64image)

                Webcam.reset();

            }
        });
    }
    function take_snapshot3() {
        html2canvas([document.getElementById('sign-pad2')], {
            onrendered: function(canvas) {
                var canvas_data = canvas.toDataURL('image/jpeg');
                var img_data = canvas_data.replace(/^data:image\/(png|jpg);base64,/, "");
                document.getElementById('results3').innerHTML =
                    '<img id="imageprev3" src="' + canvas_data + '" alt="' + img_data + '"/>';

                var base64image2 = document.getElementById("imageprev3").src;

                $('#file_absen2').val(base64image2)

                Webcam.reset();

            }
        });
    }
</script>
<script>
    $(document).ready(function() {
       

    });

    

   
</script>
<script>
    $(document).ready(function() {
        getLocation()
        t = $('#data_list').DataTable();
        t.clear().draw(false);
        $.ajax({
            type: "get",
            url: "absensi/kunjungan_harian_json", //json get site
            dataType: 'json',
            success: function(response) {
                arrData = response['data'];
                var j = 0;
//<div class="text-center">' + (arrData[i]['cek'] == 0 ? '<button type="button" class="btn btn-primary btn-xs" data-target="#modalAddForkopimda" data-id=' + arrData[i]['id'] + ' onclick="setCameranLocation(this)" data-toggle="modal" style="margin-top:5px">Absen</button>' : 'Sudah Absen') + '</div>                
                for (i = 0; i < arrData.length; i++) {
                    t.row.add([
                        '<div class="text-left">' + arrData[i]['nama'] + '</div>',
                        '<div class="text-left">' + formatDate(arrData[i]['awal_waktu_pelaksanaan']) + '</div>',
                        '<div class="text-left">' + arrData[i]['waktu'] + '</div>',
                        '<div class="text-left">' + tipeKunjungan(arrData[i]['tipe_kunjungan']) + '</div>',
                        '<div class="text-left">' + arrData[i]['sub_tipe'] + '</div>',
                        '<div class="text-center"><button type="button" class="btn btn-primary btn-xs" data-target="#daftar' + arrData[i]['id'] + '" data-id=""  data-toggle="modal" style="margin-top:5px">Absen <?php echo $tipe ?></button></div>'
                    ]).draw(false);
                }
            }
        });
    });
    $(document).ready(function() {
        getLocation()
        t = $('#data_list').DataTable();
        t.clear().draw(false);
        $.ajax({
            type: "get",
            url: "absensi/rapat_harian_json", //json get site
            dataType: 'json',
            success: function(response) {
//<div class="text-center">' + (arrData[i]['cek'] == 0 ? '<button type="button" class="btn btn-primary btn-xs" data-target="#modalAddRapat" data-id=' + arrData[i]['id'] + ' onclick="setCameranLocation(this)" data-toggle="modal" style="margin-top:5px">Absen</button>' : 'Sudah Absen') + '</div>                
                arrData = response['data'];
                var j = 0;
                for (i = 0; i < arrData.length; i++) {
                    t.row.add([
                        '<div class="text-left">' + arrData[i]['title'] + '</div>',
                        '<div class="text-left">' + formatDate(arrData[i]['tanggal']) + '</div>',
                        '<div class="text-left">' + arrData[i]['waktu'] + '</div>',
                        '<div class="text-left">' + tipeRapat(arrData[i]['tipe']) + '</div>',
                        '<div class="text-left">' + arrData[i]['tempat'] + '</div>',
                        '<div class="text-center"><button type="button" class="btn btn-primary btn-xs" data-target="#daftarRapat' + arrData[i]['id'] + '" data-id=""  data-toggle="modal" style="margin-top:5px">Absen <?php echo $tipe ?></button></div>'
                    ]).draw(false);
                }
            }
        });
    });

    function setCameranLocation(eq) {
        var id = $(eq).data('id')
        $('#id').val(id)
/*         Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,

        });
        Webcam.attach('#my_camera');
 */    }
    function setCameranLocation2(eq) {
        var id = $(eq).data('id')
        $('#id2').val(id)
/*         Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,

        });
        Webcam.attach('#my_camera');
 */    }

    function configure() {
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');
    }

    function take_snapshot() {
        // take snapshot and get image data
        Webcam.snap(function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                '<img id="imageprev" src="' + data_uri + '"/>';
        });
        var base64image = document.getElementById("imageprev").src;

        $('#file_absen').val(base64image)

        Webcam.reset();
    }

    function checkSubmited() {
        var longitude = $('#longitude').val();
        var latitude = $('#latitude').val();
        var file_absen = $('#file_absen').val();
        if (longitude == '' || latitude == '' || file_absen == '') {

            if (confirm("halaman ini akan di refresh?")) {
                location.reload()
            }
        } else {
            $('#form_absen').submit();
        }
    }
    function checkSubmited2() {
        var longitude = $('#longitude2').val();
        var latitude = $('#latitude2').val();
        var file_absen = $('#file_absen2').val();
        if (longitude == '' || latitude == '' || file_absen == '') {

            if (confirm("halaman ini akan di refresh?")) {
                location.reload()
            }
        } else {
            $('#form_absen2').submit();
        }
    }

    function saveSnap() {
        // Get base64 value from <img id='imageprev'> source
        var base64image = document.getElementById("imageprev").src;
        // console.log(base64image)
        $('#file_absen').val(base64image)
        // Webcam.upload( base64image, 'rapat/upload', function(code, text) {
        // console.log('Save successfully');
        // //console.log(text);
        // });

    }

    // var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    

    function showPosition(position) {
        // x.innerHTML = "Latitude: " + position.coords.latitude + 
        // "<br>Longitude: " + position.coords.longitude;
        $('#longitude').val(position.coords.longitude)
        $('#latitude').val(position.coords.latitude)
        $('#longitude2').val(position.coords.longitude)
        $('#latitude2').val(position.coords.latitude)
    }

    function formatMonth(date) {
        var temp = date.split(/[.,\/ -]/);
        return temp[1] + '-' + temp[0];
    }

    function formatDate(date) {
        var temp = date.split(/[.,\/ -]/);
        return temp[2] + '-' + temp[1] + '-' + temp[0];
    }

    function formatDate2(date) {
        if (date == null) {
            return '-';
        } else {

            var myDate = new Date(date);
            var tgl = date.split(/[ -]+/);
            var output = tgl[2] + "-" + tgl[1] + "-" + tgl[0] + ' ' + tgl[3];
            return output;
        }
    }

    function tipeKunjungan(tipe) {
        if (tipe == 1) {
            return 'Kunker';
        } else if (tipe == 2) {
            return 'Hiring'
        } else if (tipe == 3) {
            return 'Sidak'
        } else {
            return ''
        }
    }
    function tipeRapat(tipe) {
        if (tipe == 1) {
            return 'Paripurna';
        } else if (tipe == 2) {
            return 'Komisi'
        } else if (tipe == 3) {
            return 'Bamus'
        } else if (tipe == 4) {
            return 'Banggar'
        }else {
            return ''
        }
    }
</script>