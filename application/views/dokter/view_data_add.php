<section class="content mt-2">
    <div class="container-fluid">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <?= $title; ?>

                <a href="<?= base_url('dokter'); ?>" class="btn btn-warning btn-sm float-right">Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dokter/insert'); ?>" method="post">
                    <div class="form-group">
                        <label for="">Nama Dokter</label>
                        <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                    </div>
            
                </form>
            </div>
        </div>
    </div>

</section>