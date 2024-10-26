<h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>

<!-- Tampilkan pesan error -->
<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<form action="<?= base_url('product/update/' . $product->id); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="thumbnail">Thumbnail</label>
        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
        <small>Biarkan kosong jika tidak ingin mengubah thumbnail.</small>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= set_value('kategori', $product->kategori); ?>" required>
    </div>
    <div class="form-group">
        <label for="produk">Nama Produk</label>
        <input type="text" class="form-control" id="produk" name="produk" value="<?= set_value('produk', $product->produk); ?>" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="<?= set_value('harga', $product->harga); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="<?= base_url('product'); ?>" class="btn btn-secondary">Kembali</a>
</form>
