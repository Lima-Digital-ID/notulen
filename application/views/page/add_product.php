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
                    <h4 class="card-title">Tambah Produk</h4>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Input Kode / Scan Barcode</label>
                            <input type="text" class="form-control" id="kode" onchange="addProduct(this)" autofocus>
                        </div>   
                        <!-- <button class="btn btn-success" type="button">Tambah</button>                      -->
                        <!-- <br>
                        <br> -->
                    <form class="mt-4" action="<?=base_url('welcome/save_product')?>" method="post" id="form_add">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bulan</label>
                            <input type="month" class="form-control" name="month" value="<?=date('Y-m')?>">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="date" value="<?=date('Y-m-d')?>">
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
        is_cek=cek(nama);
        if(is_cek == false){
            list_barcodes.push(nama);
            var tdAdd='<tr>'+
                            '<td><input name="kode[]" readonly class="form-control" value="'+nama+'"></td>'+
                            '<td><input name="notes[]" class="form-control" placeholder="" readonly value="Pickup Barang"></td>'+
                            '<td><button type="button" class="btn btn-sm btn-danger removeOption" data-id="'+nama+'"><i class="mdi mdi-delete"></i></button></td>'+
                        '</tr>';
        }
        $('#detail-order').find('tbody:last').append(tdAdd);
        $('#kode').val('');
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