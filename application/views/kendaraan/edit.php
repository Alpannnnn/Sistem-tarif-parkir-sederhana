<!DOCTYPE html>
<html>
<head>
    <title>Edit Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Edit Kendaraan</h1>

    <form action="<?= base_url('master_kendaraan/update') ?>" method="post">

        <input type="hidden" name="plat" value="<?= $k->plat ?>">

        <label class="block mb-2">Jenis</label>
        <select name="jenis" class="w-full border p-2 rounded mb-4">
            <option value="Motor" <?= $k->jenis == 'Motor' ? 'selected' : '' ?>>Motor</option>
            <option value="Mobil" <?= $k->jenis == 'Mobil' ? 'selected' : '' ?>>Mobil</option>
        </select>

        <label class="block mb-2">Merk</label>
        <input type="text" name="merk" value="<?= $k->merk ?>" class="w-full border p-2 rounded mb-4">

        <label class="block mb-2">Warna</label>
        <input type="text" name="warna" value="<?= $k->warna ?>" class="w-full border p-2 rounded mb-4">

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        <a href="<?= base_url('master_kendaraan') ?>" class="ml-2 text-gray-600">Batal</a>

    </form>

</div>

</body>
</html>
