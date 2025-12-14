<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg">

        <h2 class="text-2xl font-bold text-center mb-4">Login Operator</h2>

        <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-100 text-red-700 px-3 py-2 rounded mb-3">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('login/auth'); ?>" method="POST">

            <label class="block mb-2 font-medium">Username</label>
            <input type="text" name="username" required
                   class="w-full px-3 py-2 border rounded focus:ring">

            <label class="block mt-3 mb-2 font-medium">Password</label>
            <input type="password" name="password" required
                   class="w-full px-3 py-2 border rounded focus:ring">

            <p class="text-center mt-4">
    Belum punya akun?
    <a href="<?= base_url('login/register'); ?>" class="text-blue-600">Register</a>
</p>


            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 mt-4 rounded hover:bg-blue-700">
                Login
            </button>

        </form>
    </div>

</body>
</html>
