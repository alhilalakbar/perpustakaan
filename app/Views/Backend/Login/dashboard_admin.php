<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <?php
    $persenDipinjam = ($totalStok > 0)
        ? round(($totalDipinjam / $totalStok) * 100)
        : 0;
    ?>

    <!-- BREADCRUMB -->
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </div>

    <!-- HEADER -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Dashboard Admin Perpustakaan</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- ALERT -->
    <?php if ($totalTerlambat > 0): ?>
    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-warning-sign"></span>
        Ada <strong><?= $totalTerlambat; ?></strong> buku yang terlambat dikembalikan.
    </div>
    <?php endif; ?>

    <!-- KPI -->
    <div class="row">

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Total Buku</div>
                <div class="panel-body text-center">
                    <h2><?= $totalBuku; ?></h2>
                    <span class="glyphicon glyphicon-book" style="font-size:40px;"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">Total Anggota</div>
                <div class="panel-body text-center">
                    <h2><?= $totalAnggota; ?></h2>
                    <span class="glyphicon glyphicon-user" style="font-size:40px;"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">Sedang Dipinjam</div>
                <div class="panel-body text-center">
                    <h2><?= $totalDipinjam; ?></h2>
                    <span class="glyphicon glyphicon-transfer" style="font-size:40px;"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">Total Denda</div>
                <div class="panel-body text-center">
                    <h2>Rp <?= number_format($totalDenda); ?></h2>
                    <span class="glyphicon glyphicon-usd" style="font-size:40px;"></span>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK ACTION -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Quick Action</div>
                <div class="panel-body">
                    <a href="<?= base_url('admin/master-data-buku'); ?>" class="btn btn-primary">
                        Buku
                    </a>

                    <a href="<?= base_url('admin/master-data-anggota'); ?>" class="btn btn-success">
                        Anggota
                    </a>

                    <a href="<?= base_url('admin/peminjaman-step-1'); ?>" class="btn btn-warning">
                        Peminjaman
                    </a>

                    <a href="<?= base_url('admin/data-transaksi-pengembalian'); ?>" class="btn btn-danger">
                        Pengembalian
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ANALYTICS -->
    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Statistik Sistem</div>
                <div class="panel-body">

                    <ul class="list-group">
                        <li class="list-group-item">
                            Total Kategori
                            <span class="badge"><?= $totalKategori; ?></span>
                        </li>

                        <li class="list-group-item">
                            Total Stok
                            <span class="badge"><?= $totalStok; ?></span>
                        </li>

                        <li class="list-group-item">
                            Sudah Dikembalikan
                            <span class="badge"><?= $totalKembali; ?></span>
                        </li>

                        <li class="list-group-item">
                            Transaksi Hari Ini
                            <span class="badge"><?= $transaksiHariIni; ?></span>
                        </li>
                    </ul>

                    <hr>

                    <label>Utilisasi Buku</label>

                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" style="width: <?= $persenDipinjam; ?>%">
                            <?= $persenDipinjam; ?>%
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- STOK MENIPIS -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Buku Stok Menipis</div>
                <div class="panel-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($stokMenipis)): ?>
                            <?php foreach ($stokMenipis as $buku): ?>
                            <tr>
                                <td><?= $buku['judul_buku']; ?></td>
                                <td>
                                    <span class="label label-danger">
                                        <?= $buku['jumlah_eksemplar']; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center">
                                    Semua stok aman
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>