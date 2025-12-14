<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-xl mx-auto bg-white p-6 shadow-lg rounded">

    <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

    <form method="post" 
          action="<?= isset($op) ? site_url('operator/update') : site_url('operator/simpan') ?>">

        <?php if (isset($op)): ?>
            <input type="hidden" name="id_operator" value="<?= $op->id_operator ?>">
        <?php endif; ?>

        <label class="font-semibold">Nama Operator</label>
        <input type="text" name="nama_operator"
               value="<?= isset($op) ? $op->nama_operator : '' ?>"
               class="w-full p-2 border rounded mb-3" required>

        <label class="font-semibold">Username</label>
        <input type="text" name="username"
               value="<?= isset($op) ? $op->username : '' ?>"
               class="w-full p-2 border rounded mb-3" required>

        <label class="font-semibold">Password <?= isset($op) ? '(optional)' : '' ?></label>
        <input type="password" name="password"
               class="w-full p-2 border rounded mb-4">

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        <a href="<?= site_url('operator') ?>" class="px-4 py-2 bg-gray-500 text-white rounded ml-2">Kembali</a>
    </form>

</div>

</body>
</html>
