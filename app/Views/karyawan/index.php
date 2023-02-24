<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h2 class="mt-2">Daftar Karyawan</h2>
            <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan keyword pencarian.." name="keyword">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1 )); ?>
                    <?php foreach ($karyawan as $k): ?>
                    <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $k['nama']; ?></td>
                    <td><?= $k['alamat']; ?></td>
                    <td><a href=""class="btn btn-dark">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('karyawan', 'karyawan_pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>