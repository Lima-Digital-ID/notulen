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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Absensi Rapat <?= $rapat->title ?></div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Absensi</td>
                                        <td>Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($tipe_pegawai as $key => $value) {
                                        $key++;
                                ?>
                                    <tr>
                                        <td><?= $key ?></td>
                                        <td><?= $value['tipe'] ?></td>
                                        <td><a href="" data-toggle="modal" data-tipe="<?= $value['id_tipe'] ?>" data-target="#myModal" data-peserta="<?= $value['tipe'] ?>" class="btn-peserta btn btn-primary btn-xs">Absensi</a></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Peserta Rapat (<span id="peserta"></span>)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
<div id="modalAbsenRapat" class="modal fade" role="dialog" aria-labelledby="mopdalAbsenRapatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mopdalAbsenRapatLabel">Tambah Forkopimda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="<?= base_url('absensi/uploadrapat') ?>" method="post" id="form_absen2">
                <div class="modal-body">
                <input type="hidden" name="from" value="rapat">
                <input type="hidden" id="id2" name="id2">
                <input type="hidden" name="id_tipe" id="id_tipe" value="">
                    <div class="signature-area" id="signature-area2">
                        <h2 class="title-area">Put signature,</h2>
                        <div class="sig sigWrapper" style="height:auto;">
                            <div class="typed"></div>
                            <canvas class="sign-pad" id="sign-pad2" width="300" height="100"></canvas>
                        </div>
                    </div>
                    <input type="button" class="btn-save" value="ok" />
                    <input type="button" class="btn-clear" value="clear" />
                    <div id="results3"></div>
                    <input type="hidden" name="longitude" id="longitude2">
                    <input type="hidden" name="latitude" id="latitude2">
                    <input type="hidden" name="file_absen" id="file_absen2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-submit waves-effect">Simpan</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/') ?>js/webcam/webcam.min.js"></script>
<script src="<?= base_url('assets/') ?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        getLocation()
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        // function setCameranLocation2(eq) {
        //     var id = $(eq).data('id')
        //     $('#id2').val(id)
        // }

        $(".btn-peserta").click(function(){
            $("#peserta").html($(this).data('peserta'))            

            var id_tipe = $(this).data('tipe')
            $.ajax({
                type : "get",
                data : {id_rapat : <?= $_GET['id_rapat'] ?>,id_tipe : id_tipe},
                url : 'absensi/get_peserta',
                dataType : 'json',
                success : function(res){
                    $("#myModal .modal-body").empty()
                    $.each(res,function(i,v){
                        var absen
                        if (v.status_absen == 0 ) {
                            absen = `<button type="button" class="btn btn-primary mt-2" data-target="#modalAbsenRapat" data-tipe="${id_tipe}" data-toggle="modal" style="margin-top:5px">Absen</button>`
                        } 
                        else {
                            absen = `<p class="btn btn-success mt-2">Sudah Absen</p>`
                        }  
                        $("#myModal .modal-body").append(`
                            <div class="row detail-field mb-3">
                                <div class="col-md-8">
                                    <h4 class="form-control" style="height:auto">${v.nama_pegawai}</h4>
                                </div>
                                <div class="col-md-4" style="margin-top: -5px;" >
                                    ${absen}
                                </div>
                            </div>
                        `)
                        $("button[data-target='#modalAbsenRapat']").click(function(){
                            $("#modalAbsenRapat #id_tipe").val(id_tipe)
                            $('#id2').val(v.id)
                            // setCameranLocation2(this)
                        })
                    })
                }
            })
        })

        function showPosition(position) {
            $('#longitude2').val(position.coords.longitude)
            $('#latitude2').val(position.coords.latitude)
        }
        $(".btn-submit").click(function(){
            var longitude = $('#longitude2').val();
            var latitude = $('#latitude2').val();
            var file_absen = $('#file_absen2').val();
            if (longitude == '' || latitude == '' || file_absen == '') {
                alert('Tekan tombol OK dan Simpan untuk absensi')
            } else {
                $('#form_absen2').submit();
            }
        })

        $('#signature-area2').signaturePad({
            drawOnly: true,
            drawBezierCurves: true,
            lineTop: 90
        });
        $(".btn-save").click(function(){
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
        })
        $(".btn-clear").click(function(e) {
            $('#signature-area2').signaturePad().clearCanvas();
        });

        <?php 
            if(isset($_GET['showModal'])){
        ?>
            $(".btn-peserta[data-tipe='<?= $_GET['tipe'] ?>']").trigger('click')
        <?php } ?>
    })
</script>