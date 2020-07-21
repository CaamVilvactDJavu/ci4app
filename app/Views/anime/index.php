<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2" style="font-style:italic;">List Anime</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search keyword . . ." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                    </div>
                    <div>
                        <a href="/anime/create" class="btn btn-dark px-12">Add list anime</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
                        <th scope="col">Genre</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($anime as $a) : ?>
                        <tr class="table-light">
                            <td scope="row"><?= $i++; ?></td>
                            <td><img src="/img/<?= $a['sampul']; ?>" alt="" width="150"></td>
                            <td><?= $a['judul']; ?></td>
                            <td><?= $a['genre']; ?></td>
                            <td>
                                <a href="/anime/<?= $a['slug']; ?> " class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $pager->links('anime', 'bootstrap_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>