<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                <div class="card-body">
                    <h4 class="card-title"><?=$title?></h4>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bulan</label>
                            <input type="month" class="form-control" id="month" name="month" value="<?=date('Y-m')?>">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Input Kode / Scan Barcode yang Dikirim</label>
                            <input type="text" class="form-control" id="kode" onchange="addProduct(this)" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Input Kode / Scan Barcode yang Diretur</label>
                            <input type="text" class="form-control" id="kode1" onchange="retProduct(this)">
                        </div>     
                    <form class="mt-4" action="<?=base_url('welcome/update_kurir_load')?>" method="post">
                        <div class="form-group" hidden>
                            <label for="exampleInputEmail1">Pilih Pegawai</label>
                            <select id="select_pegawai" class="form-control select2" name="id_pegawai" style="width:100%" required>
                                <option value="">--- Pilih Pegawai ---</option>
                                <?php foreach ($pegawai as $key => $value) {
                                ?>
                                <option value="<?=$value->id_pegawai?>" <?=$value->id_pegawai == $id_pegawai ? 'selected' : ''?>><?=$value->nama_pegawai?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>   
                        <div class="form-group">
                            <label>Tanggal Paket Diterima</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?=date('Y-m-d')?>">
                        </div> 
                        <div id="table-responsive">
                            <table class="table" id="detail-order">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/')?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    var response=0;
    var list_barcodes=[];
    $(document).ready(function(){
        $("#detail-order").on("click", ".removeOption", function(event) {
            var id=$(this).data('id');
            list_barcodes.splice( list_barcodes.indexOf(id) , 1) 
            event.preventDefault();
            $(this).closest("tr").remove();
        });
    });
    function addProduct(eq){
        var nama=eq.value;
        var month=$('#month').val();
        
        if (month != '' && nama != '') {
            $.ajax({
                url : '<?=base_url('welcome/getKurirLoad')?>',
                type : 'post',
                dataType : 'json',
                async : false,
                data : {barcode : nama , month : month},
                "success" : function (response) {
                    arrData=response;
                    if (arrData != null) {
                        is_cek=cek(arrData['id']);
                        if(is_cek == false){
                            list_barcodes.push(arrData['id']);
                            var tdAdd='<tr>'+
                                    '<td><input type="hidden" name="barcode_id[]" readonly class="form-control" value="'+arrData['id']+'"><input name="kode[]" readonly class="form-control" value="'+arrData['barcode_number']+'"></td>'+
                                    '<td><input name="notes[]" class="form-control" placeholder="" readonly value="Dikirim"></td>'+
                                    '<td><button type="button" class="btn btn-sm btn-danger removeOption" data-id="'+arrData['id']+'"><i class="mdi mdi-delete"></i></button></td>'+
                                '</tr>';
                            $('#detail-order').find('tbody:last').append(tdAdd);
                        }
                        $('#kode').val('');
                        $('#kode').focus();
                    }else{
                        $('#kode').val('');
                        $('#kode').focus();
                        alert('barcode tidak ditemukan');
                    }
                    
                },
                "error" : function(){
                    $('#kode').val('');
                    alert('barcode tidak ditemukan');
                }       
            })
        }
    }
    function retProduct(eq){
        var nama=eq.value;
        var month=$('#month').val();
        
        if (month != '' && nama != '') {
            $.ajax({
                url : '<?=base_url('welcome/getKurirLoad')?>',
                type : 'post',
                dataType : 'json',
                async : false,
                data : {barcode : nama , month : month},
                "success" : function (response) {
                    arrData=response;
                    if (arrData != null) {
                        is_cek=cek(arrData['id']);
                        if(is_cek == false){
                            list_barcodes.push(arrData['id']);
                            var tdAdd='<tr>'+
                                    '<td><input type="hidden" name="barcode_id[]" readonly class="form-control" value="'+arrData['id']+'"><input name="kode[]" readonly class="form-control" value="'+arrData['barcode_number']+'"></td>'+
                                    '<td><input name="notes[]" class="form-control" placeholder="" readonly value="Retur"></td>'+
                                    '<td><button type="button" class="btn btn-sm btn-danger removeOption" data-id="'+arrData['id']+'"><i class="mdi mdi-delete"></i></button></td>'+
                                '</tr>';
                            $('#detail-order').find('tbody:last').append(tdAdd);
                        }
                        $('#kode1').val('');
                        $('#kode1').focus();
                    }else{
                        $('#kode1').val('');
                        $('#kode1').focus();
                        alert('barcode tidak ditemukan');
                    }   
                },
                "error" : function(){
                    $('#kode1').val('');
                    alert('barcode tidak ditemukan');
                }  
            })   
        }
    }
    function cek(id){
        var cek=false
        for (var i = 0; i < list_barcodes.length; i++) {
            if(id == list_barcodes[i]){
                cek=true;
            }
        }
        return cek;
    }
</script>