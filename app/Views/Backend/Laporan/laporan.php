<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-md-3">

            <div class="panel panel-warning">

                <div class="panel-heading">
                    Laporan Peminjaman
                </div>

                <div class="panel-body text-center">

                    <h2><?= count($dataPeminjaman); ?></h2>

                    <p>Total Peminjaman</p>

                    <a href="<?= base_url('admin/cetak-laporan-peminjaman'); ?>"
                       target="_blank"
                       class="btn btn-warning">

                        Cetak Laporan

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="panel panel-danger">

                <div class="panel-heading">
                    Laporan Pengembalian
                </div>

                <div class="panel-body text-center">

                    <h2><?= count($dataPengembalian); ?></h2>

                    <p>Total Pengembalian</p>

                    <a href="<?= base_url('admin/cetak-laporan-pengembalian'); ?>"
                       target="_blank"
                       class="btn btn-danger">

                        Cetak Laporan

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>