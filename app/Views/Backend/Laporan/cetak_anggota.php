<!DOCTYPE html>
<html>
<head>

    <title>Laporan Anggota</title>

    <style>

        body{
            font-family: Arial;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
            padding:8px;
        }

        h2{
            text-align:center;
        }

    </style>

</head>
<body onload="window.print()">

    <h2>Laporan Data Anggota</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Email</th>
            <th>No HP</th>
        </tr>

        <?php $no = 1; ?>

        <?php foreach($dataAnggota as $row){ ?>

        <tr>

            <td><?= $no++; ?></td>
            <td><?= $row['nama_anggota']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['no_hp']; ?></td>

        </tr>

        <?php } ?>

    </table>

</body>
</html>