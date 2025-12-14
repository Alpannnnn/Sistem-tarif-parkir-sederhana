<!DOCTYPE html>
<html>
<head>
    <title>Master Area Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Master Area Parkir</h1>

    <a href="<?= base_url('area_parkir/tambah') ?>"
       class="bg-blue-600 text-white px-4 py-2 rounded">
       + Tambah Area
    </a>

    <table class="w-full mt-4 border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Nama Area</th>
                <th class="border p-2">Lokasi</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($area as $a): ?>
            <tr>
                <td class="border p-2"><?= $a->nama_area ?></td>
                <td class="border p-2"><?= $a->lokasi ?></td>

                <td class="border p-2">
                    <a href="<?= base_url('area_parkir/edit/'.$a->id_area) ?>"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>

                    <a href="<?= base_url('area_parkir/hapus/'.$a->id_area) ?>"
                       class="bg-red-600 text-white px-3 py-1 rounded"
                       onclick="return confirm('Yakin ingin hapus?')">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>
</body>
</html>
