<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🚗 Master Kendaraan</h1>

        <div class="flex gap-2">
            <a href="<?= base_url('dashboard') ?>"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                ← Dashboard
            </a>

            <a href="<?= base_url('master_kendaraan/tambah') ?>"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Kendaraan
            </a>
        </div>
    </div>

    <!-- FLASH MESSAGE -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded overflow-hidden">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="border p-2">Plat</th>
                    <th class="border p-2">Jenis</th>
                    <th class="border p-2">Merk</th>
                    <th class="border p-2">Warna</th>
                    <th class="border p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($master_kendaraan)): ?>
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">
                            Data kendaraan belum tersedia.
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($master_kendaraan as $k): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border p-2 font-semibold"><?= $k->plat ?></td>
                    <td class="border p-2"><?= $k->jenis ?></td>
                    <td class="border p-2"><?= $k->merk ?></td>
                    <td class="border p-2"><?= $k->warna ?></td>
                    <td class="border p-2 text-center">
                        <a href="<?= base_url('master_kendaraan/edit/'.$k->plat) ?>"
                           class="inline-block bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </a>
                        <a href="<?= base_url('master_kendaraan/hapus/'.$k->plat) ?>"
                           class="inline-block bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                           onclick="return confirm('Yakin hapus kendaraan ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
