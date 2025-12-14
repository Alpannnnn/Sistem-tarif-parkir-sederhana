<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-4xl mx-auto bg-white p-6 shadow-lg rounded">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold"><?= $title ?></h1>
        <a href="<?= site_url('operator/tambah') ?>" 
           class="px-4 py-2 bg-blue-600 text-white rounded">Tambah</a>
    </div>

    <table class="w-full table-auto border rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3">ID</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Username</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($operator as $op): ?>
            <tr class="border">
                <td class="p-3"><?= $op->id_operator ?></td>
                <td class="p-3"><?= $op->nama_operator ?></td>
                <td class="p-3"><?= $op->username ?></td>
                <td class="p-3">
                    <a href="<?= site_url('operator/edit/'.$op->id_operator) ?>" class="text-blue-600">Edit</a> |
                    <a href="<?= site_url('operator/hapus/'.$op->id_operator) ?>" 
                       class="text-red-600"
                       onclick="return confirm('Yakin ingin menghapus?')">
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
