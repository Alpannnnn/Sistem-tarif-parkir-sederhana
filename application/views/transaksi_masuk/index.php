<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold"><?= $title ?></h1>
        <a href="<?= site_url('transaksi_masuk/tambah') ?>" 
           class="px-4 py-2 bg-blue-600 text-white rounded">
           + Tambah
        </a>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">ID</th>
                <th class="p-2">Plat</th>
                <th class="p-2">Jenis</th>
                <th class="p-2">Merk</th>
                <th class="p-2">Area</th>
                <th class="p-2">Waktu Masuk</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($list as $t): ?>
            <tr class="border-t">
                <td class="p-2"><?= $t->id_masuk ?></td>
                <td class="p-2 font-semibold"><?= $t->plat ?></td>
                <td class="p-2"><?= $t->jenis ?></td>
                <td class="p-2"><?= $t->merk ?></td>
                <td class="p-2"><?= $t->nama_area ?></td>
                <td class="p-2"><?= $t->waktu_masuk ?></td>
                <td class="p-2 text-center">
                    <?php if ($t->status == 'IN'): ?>
                        <span class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                            IN
                        </span>
                    <?php else: ?>
                        <span class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                            OUT
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('dashboard') ?>"
       class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded">
       ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>
