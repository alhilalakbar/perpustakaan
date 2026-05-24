<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <!-- BREADCRUMB -->
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Transaksi</li>
            <li class="active">Peminjaman</li>
        </ol>
    </div>

    <!-- DATA ANGGOTA -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h3>Data Anggota</h3>
                    <hr />

                    <div class="form-group">
                        <label>ID Anggota</label><br>
                        <?= session()->get('idAgt'); ?>
                    </div>

                    <div class="form-group">
                        <label>Nama Anggota</label><br>
                        <?= $dataAnggota['nama_anggota']; ?>
                    </div>

                    <br>

                    <!-- KERANJANG -->
                    <h3>Keranjang Peminjaman Buku</h3>

                    <table data-toggle="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($dataTemp as $data){ ?>
                            <tr>
                                <td><?= ++$no; ?></td>
                                <td><?= $data['judul_buku']; ?></td>
                                <td><?= $data['pengarang']; ?></td>
                                <td><?= $data['penerbit']; ?></td>
                                <td><?= $data['tahun']; ?></td>
                                <td>
                                    <a href="#" onclick="doDelete('<?= sha1($data['id_buku']); ?>')">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <span class="glyphicon glyphicon-trash"></span> Hapus
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php if($jumlahTemp > 0){ ?>
                        <br>
                        <a href="<?= base_url('admin/simpan-transaksi-peminjaman'); ?>">
                            <button class="btn btn-primary btn-block">
                                Simpan Transaksi Peminjaman Buku
                            </button>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <!-- DATA BUKU -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <table 
                        data-toggle="table" 
                        data-search="true" 
                        data-pagination="true"
                        class="table table-bordered">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Jumlah</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Rak</th>
                                <th>Cover</th>
                                <th>E-Book</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 0; foreach($dataBuku as $data){ ?>
                            <tr>
                                <td><?= ++$no; ?></td>
                                <td><?= $data['judul_buku']; ?></td>
                                <td><?= $data['pengarang']; ?></td>
                                <td><?= $data['penerbit']; ?></td>
                                <td><?= $data['tahun']; ?></td>
                                <td><?= $data['jumlah_eksemplar']; ?></td>
                                <td><?= $data['nama_kategori']; ?></td>
                                <td><?= $data['keterangan']; ?></td>
                                <td><?= $data['nama_rak']; ?></td>

                                <td>
                                    <img src="<?= base_url('Assets/CoverBuku/'.$data['cover_buku']); ?>" width="80">
                                </td>

                                <td>
                                    <a href="<?= base_url('Assets/E-Book/'.$data['e_book']); ?>" target="_blank">
                                        <?= $data['e_book']; ?>
                                    </a>
                                </td>

                                <td>
                                    <?php if($data['jumlah_eksemplar'] != "0"){ ?>
                                        <a href="<?= base_url('admin/simpan-temp-pinjam/'.sha1($data['id_buku'])); ?>">
                                            <button class="btn btn-primary btn-sm">Pinjam</button>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- SCRIPT -->
<script type="text/javascript">
function doDelete(idDelete) {
    swal({
        title: "Hapus Data Peminjaman?",
        text: "Data ini akan terhapus permanen!!",
        icon: "warning",
        buttons: true,
        dangerMode: false,
    })
    .then(ok => {
        if (ok) {
            window.location.href = '<?= base_url() ?>/admin/hapus-temp/' + idDelete;
        }
    });
}
</script>