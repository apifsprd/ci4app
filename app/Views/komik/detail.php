<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-4">Detail Komik</h2>

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('img'); ?>/<?= $komik['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['judul']; ?></h5>
                            <p class="card-text"><b>Penulis :</b> <?= $komik['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit :</b> <?= $komik['penerbit']; ?></small></p>

                            <a href="" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="" class="btn btn-sm btn-outline-danger">Delete</a>
                            <br><br>
                            <a href="<?= base_url('komiks'); ?>">Kembali ke daftar komik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>