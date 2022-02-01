<div class="row detail-field mb-3" data-id='<?= $now; ?>'>
    <div class="col-md-4">
       <?php
    $db = $this->db->query("SELECT * FROM tbl_pegawai WHERE tipe=1")->result();
     if($tipe == 2) { ?>
            <input type="text" name="nama[]" class="form-control" />
        <?php }else{ ?>
            <select  name="nama[]" class="form-control select2" style="width:100%">
            <?php 
            foreach ($db as $key => $value) {?>
                <option value="<?= $value->nama_pegawai ?>"><?= $value->nama_pegawai ?></option>
            <?php } ?>
        </select>
        <?php } ?>


    </div>
    <div class="col-md-2">
        <select name="absen[]" class="form-control select2" style="width:100%">
            <option value="1">Hadir</option>
            <option value="2">Tidak Hadir</option>
        </select>
    </div>
    <?php
    if ($start != 1) {
    ?>
        <div class="col-md-2" style="margin-top: -28px;">
            <br>
            <?php
            if (isset($edit)) {
            ?>
                <a href="" data-target='<?= $now; ?>' class="btn btn-danger mt-2 removeField editRemoveField" data-id='<?= $value['id_detail'] ?>'>Hapus</a>
            <?php
            } else {
            ?>
                <a href="" data-target='<?= $now; ?>' class="btn btn-danger mt-2 removeField">Hapus</a>
            <?php
            }
            ?>
        </div>
    <?php } ?>
</div>