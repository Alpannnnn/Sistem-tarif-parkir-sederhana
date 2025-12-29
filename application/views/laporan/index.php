<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? $title : 'Laporan'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="max-w-7xl mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold mb-1">📊 Laporan Transaksi</h1>
    <p class="text-gray-600 mb-6">Filter laporan transaksi berdasarkan tanggal atau bulan</p>

    <!-- FILTER -->
    <form method="GET" action="<?php echo base_url('laporan'); ?>" class="bg-white p-6 rounded shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">

            <!-- TANGGAL -->
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       value="<?php echo isset($filter['tanggal']) ? $filter['tanggal'] : ''; ?>"
                       class="border p-2 rounded w-full">
            </div>

            <!-- BULAN -->
            <div>
                <label class="block text-sm font-medium mb-1">Bulan</label>
                <input type="month"
                       name="bulan"
                       value="<?php echo isset($filter['bulan']) ? $filter['bulan'] : ''; ?>"
                       class="border p-2 rounded w-full">
            </div>

            <!-- FILTER & RESET -->
            <div class="flex gap-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white rounded px-5 py-2">
                    Filter
                </button>
                <a href="<?php echo base_url('laporan'); ?>"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 rounded px-5 py-2 text-center">
                    Reset
                </a>
            </div>

            <!-- EXPORT PDF -->
            <div>
                <a href="<?php echo base_url('laporan/export_pdf?' . http_build_query($_GET)); ?>"
                   target="_blank"
                   class="block text-center bg-red-600 hover:bg-red-700 text-white rounded px-5 py-2">
                    Export PDF
                </a>
            </div>

            <!-- EXPORT EXCEL -->
            <div>
                <a href="<?php echo base_url('laporan/export_excel?' . http_build_query($_GET)); ?>"
                   class="block text-center bg-green-600 hover:bg-green-700 text-white rounded px-5 py-2">
                    Export Excel
                </a>
            </div>

        </div>
    </form>

    <!-- RINGKASAN -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-600">Total Transaksi</p>
            <h2 class="text-2xl font-bold">
                <?php echo isset($ringkasan->total_transaksi) ? $ringkasan->total_transaksi : 0; ?>
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-600">Total Pendapatan</p>
            <h2 class="text-2xl font-bold text-green-600">
                Rp <?php echo number_format(isset($ringkasan->total_pendapatan)?$ringkasan->total_pendapatan:0,0,',','.'); ?>
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-600">Motor / Mobil</p>
            <h2 class="text-2xl font-bold">
                <?php echo isset($ringkasan->total_motor)?$ringkasan->total_motor:0; ?>
                /
                <?php echo isset($ringkasan->total_mobil)?$ringkasan->total_mobil:0; ?>
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-600">Total Member</p>
            <h2 class="text-2xl font-bold">
                <?php echo isset($ringkasan->total_member)?$ringkasan->total_member:0; ?>
            </h2>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Tanggal</th>
                    <th class="p-3 border">Plat</th>
                    <th class="p-3 border">Jenis</th>
                    <th class="p-3 border">Masuk</th>
                    <th class="p-3 border">Keluar</th>
                    <th class="p-3 border">Durasi</th>
                    <th class="p-3 border">Tarif</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($laporan)): $no=1; foreach ($laporan as $row): ?>
                <tr class="text-center border-t">
                    <td class="p-2"><?php echo $no++; ?></td>
                    <td class="p-2"><?php echo date('d/m/Y', strtotime($row->waktu_keluar)); ?></td>
                    <td class="p-2"><?php echo $row->plat; ?></td>
                    <td class="p-2"><?php echo $row->jenis_kendaraan; ?></td>
                    <td class="p-2"><?php echo date('H:i', strtotime($row->waktu_masuk)); ?></td>
                    <td class="p-2"><?php echo date('H:i', strtotime($row->waktu_keluar)); ?></td>
                    <td class="p-2"><?php echo $row->durasi; ?> jam</td>
                    <td class="p-2 text-green-600 font-bold">
                        Rp <?php echo number_format($row->tarif,0,',','.'); ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="8" class="p-6 text-center text-gray-500">
                        Tidak ada data transaksi
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
