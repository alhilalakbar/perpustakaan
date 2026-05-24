<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian</title>

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

    <h2>Laporan Pengembalian Buku</h2>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>No Pengembalian</th>
                <th>No Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>

            <?php $no = 1; ?>

            <?php foreach($dataPengembalian as $row){ ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $row['no_pengembalian']; ?></td>

                    <td><?= $row['no_peminjaman']; ?></td>

                    <td><?= $row['tgl_pengembalian']; ?></td>

                    <td>
                        Rp <?= number_format($row['denda']); ?>
                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</body>
</html>