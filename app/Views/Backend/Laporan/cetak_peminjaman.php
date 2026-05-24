<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>

    <style>
        body{
            font-family: Arial;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td{
            border: 1px solid black;
            padding: 8px;
        }

        h2{
            text-align: center;
        }
    </style>

</head>

<body onload="window.print()">

    <h2>Laporan Peminjaman Buku</h2>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>No Peminjaman</th>
                <th>Nama Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>

        </thead>

        <tbody>

            <?php $no = 1; ?>

            <?php foreach($dataPeminjaman as $row){ ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $row['no_peminjaman']; ?></td>

                    <td><?= $row['nama_anggota']; ?></td>

                    <td><?= $row['tgl_pinjam']; ?></td>

                    <td><?= ucfirst($row['status_transaksi']); ?></td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</body>
</html>