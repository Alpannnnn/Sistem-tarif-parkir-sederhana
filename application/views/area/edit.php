<!DOCTYPE html>
<html>
<head>
    <title>Edit Area Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Edit Area Parkir</h1>

    <form action="<?= base_url('master_area/update') ?>" method="post">

        <input type="hidden" name="id_area" value="<?= $a->id_area ?>">

        <label class="block mb-2">Nama Area</label>
        <select name="nama_area" class="w-full border p-2 rounded mb-4">
            <option value="A" <?= $a->nama_area == 'A' ? 'selected' : '' ?>>A</option>
            <option value="B" <?= $a->nama_area == 'B' ? 'selected' : '' ?>>B</option>
        </select>

        <label class="block mb-2">Lokasi</label>
        <select name="lokasi" class="w-full border p-2 rounded mb-4">
            <option value="Basement" <?= $a->lokasi == 'Basement' ? 'selected' : '' ?>>Basement</option>
            <option value="Rooftop" <?= $a->lokasi == 'Rooftop' ? 'selected' : '' ?>>Rooftop</option>
        </select>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        <a href="<?= base_url('master_area') ?>" class="ml-2 text-gray-600">Batal</a>

    </form>

</div>
</body>
</html>
