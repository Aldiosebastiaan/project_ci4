<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Diskon</h1>
    <nav><ol class="breadcrumb"><li class="breadcrumb-item"><a href="/">Home</a></li><li class="breadcrumb-item active">Diskon</li></ol></nav>
</div>

<section class="section">
    <div class="card">
        <div class="card-body pt-4">
            <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

            <h5><?= $editData ? 'Edit Diskon' : 'Tambah Diskon' ?></h5>
            <form action="<?= base_url('diskon/save') ?>" method="post" class="row g-3 mb-4">
                <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required value="<?= $editData['tanggal'] ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <label for="nominal" class="form-label">Nominal (Rp)</label>
                    <input type="number" name="nominal" class="form-control" required value="<?= $editData['nominal'] ?? '' ?>">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-<?= $editData ? 'success' : 'primary' ?>">
                        <?= $editData ? 'Update' : 'Simpan' ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="<?= base_url('diskon') ?>" class="btn btn-secondary ms-2">Batal</a>
                    <?php endif; ?>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nominal (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($diskon as $d): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $d['tanggal'] ?></td>
                        <td><?= number_format($d['nominal'], 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= base_url('diskon?edit=' . $d['id']) ?>" class="btn btn-sm btn-success">Ubah</a>
                            <a href="<?= base_url('diskon/hapus/' . $d['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
