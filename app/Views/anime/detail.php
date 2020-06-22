<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2" style="font-family:Hack;">Detail Anime</h2>
            <div class="card border-dark mb-3" style="max-width: 400px;">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <img src="/img/<?= $anime['sampul']; ?>" class="card-img-top" style="width: 400px;max-height:400px" alt="...">
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title"><?= $anime['judul']; ?></h5>
                            <a class="card-text"><b>Written by: </b><?= $anime['penulis']; ?> </a><br>
                            <a class="card-text"><b>Licenssed by : </b><?= $anime['lisensi']; ?> </a>
                            <p class="card-text"><small class="text-muted"><b></b> <?= $anime['keterangan']; ?></small></p>
                            <a href="" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                            <br><br>
                            <a href="/anime" class="btn btn-dark">Back to Anime list</a>
                            <!-- Example single danger button -->
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Season
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item">Season 1</a>
                                    <a class="dropdown-item">Season 2</a>
                                    <a class="dropdown-item">Season 3</a>
                                    <a class="dropdown-item">Season 4</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>