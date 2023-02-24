<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>halo ini kontak</h2>
            <?php foreach ($alamat as $a): ?>
            <table>
                <td><?= $a['tipe']; ?></td>
                <td><?= $a['alamat']; ?></td>
                <td><?= $a['kota']; ?></td>
            </table>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>