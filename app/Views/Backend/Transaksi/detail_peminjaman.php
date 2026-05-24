<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">

        <ol class="breadcrumb">

            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>

            <li>Transaksi</li>

            <li>Data Peminjaman</li>

            <li class="active">Detail Peminjaman</li>

        </ol>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>Detail Transaksi Peminjaman</h3>

                    <hr>

                    <table class="table table-bordered">

                        <tr>
                            <th width="250">No Peminjaman</th>
                            <td><?= $dataPeminjaman['no_peminjaman']; ?></td>
                        </tr>

                        <tr>
                            <th>Nama Anggota</th>
                            <td><?= $dataPeminjaman['nama_anggota']; ?></td>
                        </tr>

                        <tr>
                            <th>Tanggal Pinjam</th>
                            <td><?= $dataPeminjaman['tgl_pinjam']; ?></td>
                        </tr>

                        <tr>
                            <th>Total Pinjam</th>
                            <td><?= $dataPeminjaman['total_pinjam']; ?> Buku</td>
                        </tr>

                        <tr>
                            <th>Status Transaksi</th>

                            <td>

                                <?php if($dataPeminjaman['status_transaksi'] == "Berjalan"){ ?>

                                    <span class="label label-warning">
                                        <?= $dataPeminjaman['status_transaksi']; ?>
                                    </span>

                                <?php } else { ?>

                                    <span class="label label-success">
                                        <?= $dataPeminjaman['status_transaksi']; ?>
                                    </span>

                                <?php } ?>

                            </td>

                        </tr>

                        <tr>
                            <th>QR Code</th>
                            <td>
                                <img src="<?= base_url('Assets/qr_code/' . $dataPeminjaman['qr_code']); ?>" 
                                     width="150">
                            </td>
                        </tr>

                    </table>

                    <br>

                    <h3>Data Buku Yang Dipinjam</h3>

                    <hr>

                    <table
                        data-toggle="table"
                        data-show-refresh="true"
                        data-show-toggle="true"
                        data-show-columns="true"
                        data-search="true"
                        data-select-item-name="toolbar1"
                        data-pagination="true"
                        data-sort-name="name"
                        data-sort-order="desc"
                    >

                        <thead>

                            <tr>
                                <th data-sortable="true">No</th>
                                <th data-sortable="true">Cover</th>
                                <th data-sortable="true">Judul Buku</th>
                                <th data-sortable="true">Status Pinjam</th>
                                <th data-sortable="true">Tanggal Kembali</th>
                                <th data-sortable="true">Opsi</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php $no = 1; ?>

                            <?php foreach($detailPeminjaman as $row){ ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td>

                                        <img
                                            src="<?= base_url('Assets/CoverBuku/'.$row['cover_buku']); ?>"
                                            width="80">

                                    </td>

                                    <td><?= $row['judul_buku']; ?></td>

                                    <td>

                                        <?php if(strtolower($row['status_pinjam']) == "sedang dipinjam"){ ?>

                                            <span class="label label-info">
                                                Sedang Dipinjam
                                            </span>

                                        <?php } else { ?>

                                            <span class="label label-success">
                                                Sudah Dikembalikan
                                            </span>

                                        <?php } ?>

                                    </td>

                                    <td><?= $row['tgl_kembali']; ?></td>

                                    <td>

                                        <?php if(strtolower($row['status_pinjam']) == "sedang dipinjam"){ ?>

                                            <a href="#"
                                               class="btn btn-success btn-sm"
                                               onclick="prosesKembali('<?= $row['no_peminjaman']; ?>','<?= $row['id_buku']; ?>')">

                                                Kembalikan

                                            </a>

                                        <?php } else { ?>

                                            <button class="btn btn-default btn-sm" disabled>
                                                Sudah Dikembalikan
                                            </button>

                                        <?php } ?>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                    <div style="margin-top:20px;">

                        <a href="<?= base_url('admin/data-transaksi-peminjaman'); ?>"
                           class="btn btn-danger">

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    function prosesKembali(noPeminjaman, idBuku) {

        swal({
            title: "Kembalikan Buku?",
            text: "Pastikan buku sudah diterima kembali!",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        }).then((ok) => {

            if (ok) {

                window.location.href =
                    "<?= base_url('admin/proses-pengembalian'); ?>/" +
                    noPeminjaman + "/" + idBuku;

            }

        });

    }

</script>