<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Detail Komik</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Judul : <?= $komik['judul']; ?></h5>
                            <p class="card-text">Penulis : <?= $komik['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted">Penerbit : <?= $komik['penerbit']; ?></small></p>
                            <a href="/comics/edit/<?= $komik['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/Comics/<?= $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <!-- http method spuffing (menipu) -->
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                            </form> 



                            <br><br>
                            <a href="/comics" class="btn btn-dark">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>