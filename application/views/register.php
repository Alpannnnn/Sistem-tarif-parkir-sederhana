<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Operator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-4">Register Operator</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-500 text-white p-2 rounded mb-3">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login/simpan_register'); ?>" method="POST">

        <label class="block mb-2">Nama Operator</label>
        <input type="text" name="nama_operator" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Username</label>
        <input type="text" name="username" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Password</label>
        <input type="password" name="password" required class="w-full p-2 border rounded mb-4">

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Register
        </button>
    </form>

    <p class="text-center mt-4">
        Sudah punya akun? 
        <a href="<?= base_url('login'); ?>" class="text-blue-600">Login</a>
    </p>
</div>

</body>
</html>
