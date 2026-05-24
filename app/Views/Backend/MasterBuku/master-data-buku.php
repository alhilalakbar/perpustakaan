<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
            <li class="active">Master Data Buku</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>
                        Master Data Buku
                        <a href="<?= base_url('admin/input-buku'); ?>">
                            <button type="button" class="btn btn-sm btn-primary pull-right">
                                Input Data Buku
                            </button>
                        </a>
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
                                <th>Cover Buku</th>
                                <th data-sortable="true">Judul Buku</th>
                                <th data-sortable="true">Pengarang</th>
                                <th data-sortable="true">Penerbit</th>
                                <th data-sortable="true">Tahun</th>
                                <th data-sortable="true">Jumlah Eksemplar</th>
                                <th data-sortable="true">Kategori Buku</th>
                                <th data-sortable="true">Keterangan</th>
                                <th data-sortable="true">Rak</th>
                                <th data-sortable="true">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($dataBuku as $data) {
                            ?>
                                <tr>
                                    <td><?= $no = $no + 1; ?></td>
                                    <td>
                                        <!-- Menampilkan cover buku sesuai path Assets/CoverBuku -->
                                        <img src="<?= base_url('Assets/CoverBuku/' . $data['cover_buku']); ?>" width="80px" class="img-responsive">
                                    </td>
                                    <td><?= $data['judul_buku']; ?></td>
                                    <td><?= $data['pengarang']; ?></td>
                                    <td><?= $data['penerbit']; ?></td>
                                    <td><?= $data['tahun']; ?></td>
                                    <td><?= $data['jumlah_eksemplar']; ?></td>
                                    <td><?= $data['nama_kategori']; // Jika ingin nama, ganti ke nama_kategori ?></td>
                                    <td><?= $data['keterangan']; ?></td>
                                    <td><?= $data['nama_rak']; // Jika ingin nama, ganti ke nama_rak ?></td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            <a href="<?= base_url('admin/edit-buku/' . $data['id_buku']); ?>">
                                                <button type="button" class="btn btn-sm btn-success">
                                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                                </button>
                                            </a>

                                            <a href="#" onclick="doDelete('<?= $data['id_buku']; ?>')">
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span> Hapus
                                                </button>
                                            </a>
                                        </div>
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

<script type="text/javascript">
    function doDelete(idDelete) {
        swal({
            title: "Hapus Data Buku?",
            text: "Data buku ini akan dihapus secara permanen!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(ok => {
            if (ok) {
                window.location.href = '<?= base_url(); ?>/admin/hapus-buku/' + idDelete;
            }
        });
    }
</script>