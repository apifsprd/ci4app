<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-2">Daftar Orang</h2>

            <!-- Pencarian -->
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan keyword pencarian" aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
                    <button class="btn btn-outline-success" type="submit" name="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($orang as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                            <td><a href="" class="btn btn-secondary btn-sm">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?= $pager->links('orang', 'orang_pagination'); ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>