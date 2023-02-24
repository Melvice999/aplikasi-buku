<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">

        <!-- pesan popup berhasil input -->
            <?php if(session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success d-flex p-2 mt-3" role="alert">
                    <div class="flex-grow-1">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            
            <h2 class="mt-2">Daftar Komik</h2>
            <a href="/Comics/create" class="btn btn-primary mt-2">Tambah Komik</a>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($komik as $k): ?>
                    <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                    <td><?= $k['judul']; ?></td>
                    <td><a href="/comics/<?= $k['slug']; ?>"class="btn btn-dark">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>