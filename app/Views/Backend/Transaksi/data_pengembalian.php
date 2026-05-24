<!-- ==================== DATA PENGEMBALIAN ==================== -->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">

        <ol class="breadcrumb">

            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>

            <li>Transaksi</li>

            <li class="active">Data Pengembalian</li>

        </ol>

    </div><!--/.row-->

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>
                        Data Pengembalian Buku
                    </h3>

                    <hr />

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
                                <th data-sortable="true">No Pengembalian</th>
                                <th data-sortable="true">No Peminjaman</th>
                                <th data-sortable="true">Judul Buku</th>
                                <th data-sortable="true">Tanggal Pengembalian</th>
                                <th data-sortable="true">Denda</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php $no = 1; ?>

                            <?php foreach($dataPengembalian as $row){ ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['no_pengembalian']; ?></td>

                                    <td><?= $row['no_peminjaman']; ?></td>

                                    <td><?= $row['judul_buku']; ?></td>

                                    <td><?= $row['tgl_pengembalian']; ?></td>

                                    <td>
                                        Rp <?= number_format($row['denda']); ?>
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div><!--/.row-->

</div><!--/.main-->