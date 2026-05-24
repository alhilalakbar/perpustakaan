<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    
    <!-- Breadcrumb Section -->
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
            <li>Transaksi</li>
            <li class="active">Peminjaman</li>
        </ol>
    </div>

    <!-- Form Section -->
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>Input Anggota</h3>

                    <hr />

                    <form action="<?= base_url('admin/peminjaman-step-2'); ?>" method="post">

                        <div class="form-group col-md-6">
                            <label for="id_anggota">ID Anggota</label>

                            <input type="text"
                                   name="id_anggota"
                                   id="id_anggota"
                                   class="form-control"
                                   placeholder="Masukkan ID Anggota"
                                   required="required">
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">

                            <button type="submit" class="btn btn-primary">
                                Next
                            </button>

                            <a href="<?= base_url('admin/peminjaman-step-1'); ?>"
                               class="btn btn-danger">

                                Batal

                            </a>

                        </div>

                        <div style="clear:both;"></div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>


<?php if(session()->getFlashdata('error')){ ?>

<script type="text/javascript">

    swal({
        title: "Data Tidak Ditemukan!",
        text: "ID Anggota yang anda masukkan tidak tersedia.",
        icon: "error",
        button: "OK",
    });

</script>

<?php } ?>