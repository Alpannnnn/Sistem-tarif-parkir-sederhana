<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Parkir</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        h2, h3 {
            margin-bottom: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #f2f2f2;
            text-align: center;
        }
        .center { text-align: center; }
        .right { text-align: right; }
    </style>
</head>
<body>

<h2>LAPORAN TRANSAKSI PARKIR</h2>

<p>
<strong>Filter:</strong>
<?php
if (!empty($filter['tanggal'])) {
    echo 'Tanggal ' . date('d/m/Y', strtotime($filter['tanggal']));
} elseif (!empty($filter['bulan'])) {
    echo 'Bulan ' . date('F Y', strtotime($filter['bulan'] . '-01'));
} else {
    echo 'Semua Data';
}
?>
</p>

<p><strong>Dicetak:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>

<hr>

<h3>RINGKASAN</h3>
<table>
    <tr>
        <th>Total Transaksi</th>
        <td><?php echo $ringkasan->total_transaksi; ?></td>
    </tr>
    <tr>
        <th>Total Pendapatan</th>
        <td>Rp <?php echo number_format($ringkasan->total_pendapatan,0,',','.'); ?></td>
    </tr>
    <tr>
        <th>Total Motor</th>
        <td><?php echo $ringkasan->total_motor; ?></td>
    </tr>
    <tr>
        <th>Total Mobil</th>
        <td><?php echo $ringkasan->total_mobil; ?></td>
    </tr>
    <tr>
        <th>Total Member</th>
        <td><?php echo $ringkasan->total_member; ?></td>
    </tr>
</table>

<br>

<h3>DETAIL TRANSAKSI</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Plat</th>
            <th>Jenis</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Durasi</th>
            <th>Tarif</th>
            <th>Operator</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($laporan)): $no=1; foreach ($laporan as $row): ?>
        <tr>
            <td class="center"><?php echo $no++; ?></td>
            <td class="center"><?php echo date('d/m/Y', strtotime($row->waktu_keluar)); ?></td>
            <td class="center"><?php echo $row->plat; ?></td>
            <td class="center"><?php echo $row->jenis_kendaraan; ?></td>
            <td class="center"><?php echo date('H:i', strtotime($row->waktu_masuk)); ?></td>
            <td class="center"><?php echo date('H:i', strtotime($row->waktu_keluar)); ?></td>
            <td class="center"><?php echo $row->durasi; ?> jam</td>
            <td class="right">Rp <?php echo number_format($row->tarif,0,',','.'); ?></td>
            <td class="center"><?php echo $row->operator_nama; ?></td>
        </tr>
    <?php endforeach; else: ?>
        <tr>
            <td colspan="9" class="center">Tidak ada data</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
