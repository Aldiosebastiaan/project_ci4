<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<?php
if (session()->getFlashData('failed')) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Model</th>
            <th scope="col">Deskripsi</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product_category as $index => $productcategory) : ?>
            <tr>
                <th scope="row"><?php echo $index + 1 ?></th>
                <td><?php echo $productcategory['nama'] ?></td>
                <td><?php echo $productcategory['model'] ?></td>
                <td><?php echo $productcategory['deskripsi'] ?></td>

                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#editModal-<?= $productcategory['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('productcategory/delete/' . $productcategory['id']) ?>" class="btn btn-danger"
                        onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <!-- End Table with stripped rows -->
            <!-- Add Modal Begin -->
            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('productcategory') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Model</label>
                                    <input type="text" name="model" class="form-control" id="model" placeholder="Model Barang"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                        placeholder="Deskripsi Barang" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add Modal End -->
            <!-- Edit Modal Begin -->
            <div class="modal fade" id="editModal-<?= $productcategory['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('productcategory/edit/' . $productcategory['id']) ?>" method="post"
                            enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        value="<?= $productcategory['nama'] ?>" placeholder="Nama Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Model</label>
                                    <input type="text" name="model" class="form-control" id="model"
                                        value="<?= $productcategory['model'] ?>" placeholder="Model Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                        value="<?= $productcategory['deskripsi'] ?>" placeholder="Deskripsi Barang"
                                        required>
                                </div>

                                <!-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                        <label class="form-check-label" for="check">
                            Ceklis jika ingin mengganti foto
                        </label>
                    </div> -->
                                <!-- <div class="form-group">
                        <label for="name">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </tbody>
</table>
<!-- Edit Modal End -->
<?= $this->endSection() ?>