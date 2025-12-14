<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tarif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Tambah Tarif</h1>

    <form action="<?= base_url('master_tarif/simpan') ?>" method="post">

        <label class="block mb-2">Jenis Kendaraan</label>
        <select name="jenis" class="w-full border p-2 rounded mb-4">
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
        </select>

        <label class="block mb-2">Tarif Weekday</label>
        <input type="number" name="tarif_weekday" class="w-full border p-2 rounded mb-4">

        <label class="block mb-2">Tarif Weekend</label>
        <input type="number" name="tarif_weekend" class="w-full border p-2 rounded mb-4">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="<?= base_url('master_tarif') ?>" class="ml-2 text-gray-600">Batal</a>

    </form>

</div>

</body>
</html>
