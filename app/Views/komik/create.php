<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-4">Tambah Data Komik</h2>

            <form action="<?= base_url('komiks/save'); ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('judul'); ?></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>

                    <div class="col-sm-2">
                        <img src="<?= base_url('img'); ?>/default.png" class="img-thumbnail img-preview" alt="">
                    </div>

                    <div class="col-sm-8">
                        <input class="form-control form-control-sm <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" type="file" onchange="previewImg()">
                        <div class="invalid-feedback"><?= $validation->getError('sampul'); ?></div>
                    </div>
                </div>


                <button type="submit" class="btn btn-success btn-sm">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>