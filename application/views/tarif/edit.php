<!DOCTYPE html>
<html>
<head>
    <title>Edit Tarif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Edit Tarif</h1>

    <form action="<?= base_url('master_tarif/update') ?>" method="post">

        <input type="hidden" name="id_tarif" value="<?= $t->id_tarif ?>">

        <label class="block mb-2">Jenis Kendaraan</label>
        <select name="jenis" class="w-full border p-2 rounded mb-4">
            <option value="Motor" <?= $t->jenis == 'Motor' ? 'selected' : '' ?>>Motor</option>
            <option value="Mobil" <?= $t->jenis == 'Mobil' ? 'selected' : '' ?>>Mobil</option>
        </select>

        <label class="block mb-2">Tarif Weekday</label>
        <input type="number" name="tarif_weekday" value="<?= $t->tarif_weekday ?>" class="w-full border p-2 rounded mb-4">

        <label class="block mb-2">Tarif Weekend</label>
        <input type="number" name="tarif_weekend" value="<?= $t->tarif_weekend ?>" class="w-full border p-2 rounded mb-4">

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        <a href="<?= base_url('master_tarif') ?>" class="ml-2 text-gray-600">Batal</a>

    </form>

</div>

</body>
</html>
