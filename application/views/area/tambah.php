<!DOCTYPE html>
<html>
<head>
    <title>Tambah Area Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Tambah Area Parkir</h1>

    <form action="<?= base_url('area_parkir/simpan') ?>" method="post">

        <label class="block mb-2">Nama Area</label>
        <select name="nama_area" class="w-full border p-2 rounded mb-4">
            <option value="A">A</option>
            <option value="B">B</option>
        </select>

        <label class="block mb-2">Lokasi</label>
        <select name="lokasi" class="w-full border p-2 rounded mb-4">
            <option value="Basement">Basement</option>
            <option value="Rooftop">Rooftop</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="<?= base_url('area_parkir') ?>" class="ml-2 text-gray-600">Batal</a>

    </form>

</div>
</body>
</html>
