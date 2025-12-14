<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

<div class="max-w-5xl mx-auto bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Plat</th>
                <th class="p-2">Waktu Masuk</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>

                <?php if (empty($list)): ?>
        <tr>
            <td colspan="4" class="p-4 text-center text-gray-500">
                Tidak ada kendaraan parkir saat ini.
                <br><br>
                <a href="<?= site_url('transaksi_keluar/riwayat') ?>"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded">
                Lihat Riwayat Transaksi
                </a>
            </td>
        </tr>
        <?php endif; ?>


        <tbody>
            <?php foreach ($list as $l): ?>
            <tr class="border-t">
                <td class="p-2"><?= $l->plat ?></td>
                <td class="p-2"><?= $l->waktu_masuk ?></td>
                <td class="p-2 text-green-600 font-semibold"><?= $l->status ?></td>

                <td class="p-2">
                    <a href="<?= site_url('transaksi_keluar/proses/'.$l->id_masuk) ?>"
                       class="px-3 py-1 bg-blue-600 text-white rounded">Proses</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
