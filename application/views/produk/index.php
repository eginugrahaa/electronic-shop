<h1 class="h3 mb-4 text-gray-800">Daftar Produk</h1>
<a href="<?= base_url('product/create'); ?>" class="btn btn-primary mb-3">Tambah Produk</a>

<!-- Tampilkan pesan sukses atau error -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Kategori</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="<?= base_url('uploads/' . $product->thumbnail); ?>" alt="<?= $product->produk; ?>" width="100"></td>
                <td><?= $product->kategori; ?></td>
                <td><?= $product->produk; ?></td>
                <td><?= number_format($product->harga, 2, ',', '.'); ?></td>
                <td>
                    <a href="<?= base_url('product/edit/' . $product->id); ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('product/delete/' . $product->id); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
