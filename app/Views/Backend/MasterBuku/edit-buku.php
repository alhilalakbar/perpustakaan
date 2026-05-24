<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Buku</li>
            <li class="active">Edit Buku</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h3>Edit Data Buku</h3>
                    <hr />

                    <form action="<?= base_url('admin/update-buku'); ?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_buku" value="<?= $dataBuku['id_buku']; ?>">

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control" value="<?= $dataBuku['judul_buku']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" value="<?= $dataBuku['pengarang']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="<?= $dataBuku['penerbit']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" value="<?= $dataBuku['tahun']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Jumlah Eksemplar</label>
                            <input type="number" name="jumlah_eksemplar" class="form-control" value="<?= $dataBuku['jumlah_eksemplar']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_buku" class="form-control">
                                <?php foreach($data_kategori as $k){ ?>
                                    <option value="<?= $k['id_kategori']; ?>"
                                        <?= ($k['id_kategori'] == $dataBuku['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= $k['nama_kategori']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Rak</label>
                            <select name="rak" class="form-control">
                                <?php foreach($data_rak as $r){ ?>
                                    <option value="<?= $r['id_rak']; ?>"
                                        <?= ($r['id_rak'] == $dataBuku['id_rak']) ? 'selected' : ''; ?>>
                                        <?= $r['nama_rak']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- COVER LAMA -->
                        <div class="form-group">
                            <label>Cover Lama</label><br>
                            <img src="<?= base_url('Assets/CoverBuku/'.$dataBuku['cover_buku']); ?>" 
                                 style="width:300px; border:1px solid #ccc; padding:5px;">
                        </div>

                        <!-- GANTI COVER -->
                        <div class="form-group">
                            <label>Ganti Cover</label>
                            <input type="file" name="cover_buku" class="form-control" accept="image/*">
                            <small>Kosongkan jika tidak ingin mengganti</small>
                        </div>

                        <!-- EBOOK PREVIEW -->
                        <div class="form-group col-md-12">
                            <label>E-Book (Preview)</label>
                            <iframe 
                                src="<?= base_url('Assets/E-Book/'.$dataBuku['e_book']); ?>" 
                                width="100%" 
                                height="400px"
                                style="border:1px solid #ccc;">
                            </iframe>
                        </div>

                        <!-- GANTI EBOOK -->
                        <div class="form-group col-md-12">
                            <label>Ganti E-Book</label>
                            <input type="file" name="e_book" class="form-control" accept="application/pdf">
                            <small>Kosongkan jika tidak ingin mengganti</small>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $dataBuku['keterangan']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="<?= base_url('admin/master-data-buku'); ?>" class="btn btn-danger">Batal</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>