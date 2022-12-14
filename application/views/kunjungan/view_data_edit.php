<section class="content mt-2">
    <div class="container-fluid">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <?= $title; ?>

                <a href="<?= base_url('kunjungan'); ?>" class="btn btn-warning btn-sm float-right">Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('kunjungan/update'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $edit['id_berobat']; ?>">
                    <div class="form-group">
                        <label for="">Tanggal Berobat</label>
                        <input type="date" name="tgl_berobat" id="tgl_berobat" value="<?= $edit['tgl_berobat']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pasien</label>
                        <select name="pasien" id="pasien" class="form-control" required>
                            <?php foreach($pasien as $r){
                                if($r['id_pasien']==$edit['id_pasien']){
                                    $aktif = "selected";
                                }else{
                                    $aktif = "";
                                } ?>
                                <option value="<?= $r['id_pasien']; ?>" <?= $aktif; ?>><?= $r['nama_pasien']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Dokter</label>
                        <select name="dokter" id="dokter" class="form-control" required>
                            <?php foreach($dokter as $r){
                                if($r['id_dokter']==$edit['id_dokter']){
                                    $aktif = "selected";
                                }else{
                                    $aktif = "";
                                } ?>
                                <option value="<?= $r['id_dokter']; ?>" <?= $aktif; ?>><?= $r['nama_dokter']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Update Data</button>
                    </div>
            
                </form>
            </div>
        </div>
    </div>

</section>