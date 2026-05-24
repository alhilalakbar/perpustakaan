<!DOCTYPE html>

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

    <h2>Laporan Data Buku</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Penerbit</th>
        </tr>

        <?php $no = 1; ?>

        <?php foreach($dataBuku as $row){ ?>

        <tr>

            <td><?= $no++; ?></td>
            <td><?= $row['judul_buku']; ?></td>
            <td><?= $row['penulis']; ?></td>
            <td><?= $row['penerbit']; ?></td>

        </tr>

        <?php } ?>

    </table>

</body>
</html>