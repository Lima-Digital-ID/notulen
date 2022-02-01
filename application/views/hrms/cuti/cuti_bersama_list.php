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
                        <a href="<?=base_url('hrms/cuti/cuti_bersama_add')?>" class="btn btn-sm btn-success">Tambah Cuti Bersama</a>
                   </div>
                    
                    <table class="table table-bordered table-striped" id="zero_config">
                        <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th>Keterangan</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $key => $value) {
                            ?>
                            <tr>
                                <td><?=$value->id?></td>
                                <td><?=$value->nama?></td>
                                <td>
                                <a class='btn btn-primary text-white' data-toggle='modal' data-id="<?=$value->id?>" data-target='#cuti_detail' onclick='cekDetail(this)' title="detail"><i class='fa fa-address-book'></i></a>
                                <a href="<?=base_url('hrms/cuti/delete_cuti_bersama/'.$value->id)?>" class="btn btn-danger" onclick="javascript:return confirm('Are you sure?')"><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
<div class="modal fade" id="cuti_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped mb-0" id="detail_cuti_bersama">
            <thead>
                <tr>
                    <th>Tanggal</th>
                </tr>
            </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>