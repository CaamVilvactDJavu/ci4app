<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2" style="font-style: italic;">Detail Anime</h2>
            <div class="card border-dark mb-3" style="max-width: 400px;">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <img src="/img/<?= $anime['sampul']; ?>" class="card-img-top" style="max-width: 400px;max-height:400px" alt="...">
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title"><?= $anime['judul']; ?></h5>
                            <a class="card-text"><b>Written by: </b><?= $anime['penulis']; ?> </a><br>
                            <a class="card-text"><b>Published by : </b><?= $anime['penerbit']; ?> </a><br>
                            <a class="card-text"><b>Genre : </b><?= $anime['genre']; ?> </a>
                            <p class="card-text"><small class="text-muted"><b></b> <?= $anime['keterangan']; ?></small></p>
                            <a href="/anime/edit/<?= $anime['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/anime/<?= $anime['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">
                                    Delete
                                </button>
                            </form>
                            <br><br>
                            <a href="/anime" class="btn btn-dark">Back to Anime list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>