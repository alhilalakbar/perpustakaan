<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <?php
    $persenDipinjam = ($totalStok > 0)
        ? round(($totalDipinjam / $totalStok) * 100)
        : 0;
    ?>

    <style>
    body {
        background: #f8fafc;
        color: #1e293b;
    }

    /* Header */
    .page-header {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .breadcrumb {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    /* Navbar */
    .navbar-inverse {
        background: #ffffff !important;
        border-bottom: 1px solid #e2e8f0 !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
    }

    .navbar-inverse .navbar-brand {
        color: #1e293b !important;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .navbar-inverse .navbar-brand span {
        color: #2563eb !important;
    }

    .navbar-inverse .navbar-nav>li>a,
    .navbar-inverse .user-menu>li>a {
        color: #475569 !important;
    }

    /* Cards */
    .dashboard-card {
        min-height: 140px;
        border-radius: 12px;
        border: 1px solid #000000;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        transition: 0.2s ease;
        background: #ffffff;
    }

    .dashboard-card:hover {
        transform: translateY(-2px);
    }

    .dashboard-icon {
        font-size: 42px;
        margin-top: 10px;
    }

    /* KPI Accent */
    .panel-primary {
        border-top: 4px solid #2563eb;
    }

    .panel-success {
        border-top: 4px solid #16a34a;
    }

    .panel-danger {
        border-top: 4px solid #dc2626;
    }

    .panel-warning {
        border-top: 4px solid #f59e0b;
    }

    /* Remove ugly bootstrap panel heading colors */
    .panel-primary>.panel-heading,
    .panel-success>.panel-heading,
    .panel-danger>.panel-heading,
    .panel-warning>.panel-heading,
    .panel-default>.panel-heading,
    .panel-info>.panel-heading {
        background: #ffffff !important;
        color: #1e293b !important;
        border-bottom: 1px solid #e2e8f0 !important;
        font-weight: 600;
    }

    /* Panel */
    .panel {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    /* Buttons */
    .quick-btn {
        margin-right: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 18px;
    }

    /* Tables */
    .table th {
        background: #f1f5f9;
        color: #334155;
        font-weight: 600;
        border-color: #e2e8f0 !important;
    }

    .table td {
        color: #334155;
        border-color: #e2e8f0 !important;
    }

    /* List */
    .list-group-item {
        color: #334155;
        border-color: #e2e8f0;
    }

    /* Badges */
    .badge {
        background: #2563eb !important;
    }

    /* Progress */
    .progress {
        border-radius: 10px;
        overflow: hidden;
        height: 22px;
        background: #e2e8f0;
    }

    .progress-bar {
        font-weight: 600;
    }

    /* Labels */
    .label-danger {
        background: #dc2626;
    }

    .label-success {
        background: #16a34a;
    }

    .label-warning {
        background: #f59e0b;
    }

    /* Alert */
    .alert-warning {
        background: #fef3c7;
        border-color: #fde68a;
        color: #92400e;
    }
    </style>

    <!-- HEADER -->
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

    <div class="panel panel-default">
        <div class="panel-body">
            <h3 style="margin-top: 0; margin-bottom: 0;">
                Dashboard Admin Perpustakaan
            </h3>
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
            <div class="panel panel-primary dashboard-card">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <span class="glyphicon glyphicon-book dashboard-icon"></span>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2><?= $totalBuku; ?></h2>
                            <p>Total Buku</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-success dashboard-card">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <span class="glyphicon glyphicon-user dashboard-icon"></span>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2><?= $totalAnggota; ?></h2>
                            <p>Total Anggota</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger dashboard-card">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <span class="glyphicon glyphicon-transfer dashboard-icon"></span>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2><?= $totalDipinjam; ?></h2>
                            <p>Sedang Dipinjam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-warning dashboard-card">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <span class="glyphicon glyphicon-usd dashboard-icon"></span>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2>Rp <?= number_format($totalDenda); ?></h2>
                            <p>Total Denda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK ACTION -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Quick Action
                </div>
                <div class="panel-body">
                    <a href="<?= base_url('admin/master-data-buku'); ?>" class="btn btn-primary quick-btn">
                        Buku
                    </a>

                    <a href="<?= base_url('admin/master-data-anggota'); ?>" class="btn btn-success quick-btn">
                        Anggota
                    </a>

                    <a href="<?= base_url('admin/peminjaman-step-1'); ?>" class="btn btn-warning quick-btn">
                        Peminjaman
                    </a>

                    <a href="<?= base_url('admin/data-transaksi-pengembalian'); ?>" class="btn btn-danger quick-btn">
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
                <div class="panel-heading">
                    Statistik Sistem
                </div>
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
                <div class="panel-heading">
                    Buku Stok Menipis
                </div>
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

    <!-- TRANSAKSI TERBARU -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    Transaksi Terbaru
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No Peminjaman</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (!empty($transaksiTerbaru)): ?>
                            <?php foreach ($transaksiTerbaru as $trx): ?>
                            <tr>
                                <td><?= $trx['no_peminjaman']; ?></td>
                                <td><?= $trx['nama_anggota']; ?></td>
                                <td><?= $trx['judul_buku']; ?></td>
                                <td><?= $trx['tgl_pinjam']; ?></td>
                                <td><?= $trx['tgl_kembali']; ?></td>
                                <td>
                                    <?php if ($trx['status_pinjam'] == 'Sedang Dipinjam'): ?>
                                    <span class="label label-danger">
                                        Dipinjam
                                    </span>
                                    <?php else: ?>
                                    <span class="label label-success">
                                        Kembali
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada transaksi
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