<h2>Hasil Nilai Looping</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Nilai</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

    <?php foreach ($data as $d): ?>
    <tr>
        <td><?= $d['nilai']; ?></td>
        <td><?= $d['grade']; ?></td>
        <td><?= $d['status']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>