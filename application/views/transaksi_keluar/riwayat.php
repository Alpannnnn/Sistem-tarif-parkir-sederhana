<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6"><?= $title ?></h1>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Plat</th>
                    <th class="p-3 border">Waktu Masuk</th>
                    <th class="p-3 border">Waktu Keluar</th>
                    <th class="p-3 border">Durasi</th>
                    <th class="p-3 border">Total Biaya</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($list)): ?>
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            Belum ada transaksi keluar
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($list as $row): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border text-center"><?= $no++ ?></td>
                            <td class="p-3 border font-semibold"><?= $row->plat ?></td>
                            <td class="p-3 border">
                                <?= date('d-m-Y H:i', strtotime($row->waktu_masuk)) ?>
                            </td>
                            <td class="p-3 border">
                                <?= date('d-m-Y H:i', strtotime($row->waktu_keluar)) ?>
                            </td>
                            <td class="p-3 border text-center">
                                <?= $row->durasi ?> Jam
                            </td>
                            <td class="p-3 border text-right font-bold text-green-600">
                                Rp <?= number_format($row->total_biaya, 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="<?= site_url('transaksi_keluar') ?>"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Kembali
        </a>
    </div>

</div>

</body>
</html>
