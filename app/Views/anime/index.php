<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/anime/create" class="btn btn-dark mt-3">Add list anime</a>
            <h1 class="mt-2" style="font-style:italic;">List Anime</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($anime as $a) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $a['sampul']; ?>" alt="" width="150"></td>
                            <td><?= $a['judul']; ?></td>
                            <td>
                                <a href="/anime/<?= $a['slug']; ?> " class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $pager->links(); ?>
<?= $this->endSection(); ?>