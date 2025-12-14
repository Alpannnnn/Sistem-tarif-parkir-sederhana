<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

    <form method="post" action="<?= site_url('transaksi_masuk/simpan') ?>">

        <label class="font-semibold">Plat Kendaraan</label>
        <select name="plat" class="w-full p-2 border rounded mb-4" required>
            <option value="">-- pilih plat --</option>
            <?php foreach ($kendaraan as $k): ?>
                <option value="<?= $k->plat ?>">
                    <?= $k->plat ?> - <?= $k->merk ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="font-semibold">Area Parkir</label>
        <select name="id_area" class="w-full p-2 border rounded mb-4" required>
            <option value="">-- pilih area --</option>
            <?php foreach ($area as $a): ?>
                <option value="<?= $a->id_area ?>">
                    <?= $a->nama_area ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- 🔥 INPUT WAKTU MASUK MANUAL -->
        <label class="font-semibold">Waktu Masuk</label>
        <input type="datetime-local"
               name="waktu_masuk"
               required
               min="<?= date('Y-m-d\TH:i') ?>"
               class="w-full p-2 border rounded mb-4">

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        <a href="<?= site_url('transaksi_masuk') ?>"
           class="px-4 py-2 bg-gray-500 text-white rounded ml-2">
           Kembali
        </a>
    </form>

</div>
</body>
</html>
