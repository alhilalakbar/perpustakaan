<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Anggota</li>
            <li class="active">Edit Anggota</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Anggota</h3>
                    <hr />

                    <form action="<?= base_url('admin/update-data-anggota');?>" method="post">

                        <input type="hidden" name="id" value="<?= $data_anggota['id_anggota']; ?>">

                        <div class="form-group col-md-6">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data_anggota['nama_anggota']; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select name="jk" class="form-control">
                                <option value="L" <?= $data_anggota['jenis_kelamin']=="L"?'selected':''; ?>>Laki-laki</option>
                                <option value="P" <?= $data_anggota['jenis_kelamin']=="P"?'selected':''; ?>>Perempuan</option>
                            </select>
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>No Telepon</label>
                            <input type="text" name="no_tlp" class="form-control" value="<?= $data_anggota['no_tlp']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $data_anggota['email']; ?>">
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control"><?= $data_anggota['alamat']; ?></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Password (kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-danger">Batal</button>
                        </div>

                        <div style="clear:both;"></div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>