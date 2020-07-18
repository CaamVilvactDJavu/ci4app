<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2" style="font-style:italic;">List Orang</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($orang as $o) : ?>
                        <tr class="table-light">
                            <td scope="row"><?= $i++; ?></td>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                        </tr>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php echo $pager->links('bootstrap', 'bootstrap_pagination') ?>
<?= $this->endSection(); ?>