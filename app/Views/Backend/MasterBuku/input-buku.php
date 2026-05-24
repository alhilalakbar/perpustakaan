<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Buku</li>
            <li class="active">Input Buku</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h3>Input Data Buku</h3>
                    <hr />

                    <form action="<?= base_url('admin/simpan-buku'); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Eksemplar</label>
                            <input type="number" name="jumlah_eksemplar" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_buku" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($data_kategori as $k){ ?>
                                <option value="<?= $k['id_kategori']; ?>">
                                    <?= $k['nama_kategori']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Rak</label>
                            <select name="rak" class="form-control" required>
                                <option value="">-- Pilih Rak --</option>
                                <?php foreach($data_rak as $r){ ?>
                                <option value="<?= $r['id_rak']; ?>">
                                    <?= $r['nama_rak']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Upload Cover</label>
                            <input type="file" name="cover_buku" class="form-control" accept="image/*" required>
                        </div>

                        <div class="form-group">
                            <label>Upload E-Book (PDF)</label>
                            <input type="file" name="e_book" class="form-control" accept="application/pdf" required>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>

                            <button type="reset" class="btn btn-warning">
                                Reset
                            </button>

                            <a href="<?= base_url('admin/master-data-buku'); ?>" class="btn btn-danger">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>