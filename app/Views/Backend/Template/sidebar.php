<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li>
            <a href="<?= base_url('admin/dashboard-admin'); ?>">
                <span class="glyphicon glyphicon-dashboard"></span> Dashboard
            </a>
        </li>
        
        <li class="parent">
            <a data-toggle="collapse" href="#sub-item-master">
                <span class="glyphicon glyphicon-list"></span> Master Data 
                <span class="icon pull-right">
                    <em class="glyphicon glyphicon-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-master">
                <li>
                    <a href="<?= base_url('admin/master-data-admin');?>">
                        <span class="glyphicon glyphicon-user"></span> Data Admin
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/master-data-anggota');?>">
                        <span class="glyphicon glyphicon-user"></span> Data Anggota
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/master-data-kategori');?>">
                        <span class="glyphicon glyphicon-tags"></span> Data Kategori
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/master-data-rak');?>">
                        <span class="glyphicon glyphicon-th-large"></span> Data Rak
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/master-data-buku');?>">
                        <span class="glyphicon glyphicon-book"></span> Data Buku
                    </a>
                </li>
            </ul>
        </li>

        <li class="parent">
            <a data-toggle="collapse" href="#sub-item-transaksi">
                <span class="glyphicon glyphicon-list"></span> Transaksi 
                <span class="icon pull-right">
                    <em class="glyphicon glyphicon-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-transaksi">
                <li>
                    <a href="<?= base_url('admin/peminjaman-step-1');?>">
                        <span class="glyphicon glyphicon-export"></span> Peminjaman
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/data-transaksi-peminjaman');?>">
                        <span class="glyphicon glyphicon-list-alt"></span> Data Peminjaman
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/data-transaksi-pengembalian'); ?>">
                        <span class="glyphicon glyphicon-refresh"></span> Data Pengembalian
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?= base_url('admin/laporan'); ?>">
                <span class="glyphicon glyphicon-list-alt"></span>
                Laporan
            </a>
        </li>

        <li role="presentation" class="divider"></li>
        <li>
            <a href="<?= base_url('admin/logout'); ?>">
                <span class="glyphicon glyphicon-user"></span> Logout
            </a>
        </li>
    </ul>
    <div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Ketika sub-menu dibuka (show)
    $('.children').on('show.bs.collapse', function () {
        $(this).closest('.parent').find('.icon em').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    });

    // Ketika sub-menu ditutup (hide)
    $('.children').on('hide.bs.collapse', function () {
        $(this).closest('.parent').find('.icon em').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    });
});
</script>