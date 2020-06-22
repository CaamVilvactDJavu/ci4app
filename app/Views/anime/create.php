<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3" style="font-style: italic;">Form add a list of anime</h2>
            <form action="/anime/save" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Written by</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lisensi" class="col-sm-2 col-form-label">Licenssed by</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lisensi" name="lisensi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Cover</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-dark">Add an anime list</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>