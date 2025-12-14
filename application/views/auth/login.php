<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Parkir</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center font-sans">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- LOGO / TITLE -->
        <div class="text-center mb-6">
            <div class="text-4xl mb-2">🅿️</div>
            <h2 class="text-2xl font-bold text-gray-800">Login Operator</h2>
            <p class="text-sm text-gray-500">Sistem Parkir</p>
        </div>

        <!-- ERROR MESSAGE -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-2 rounded-lg mb-4 text-sm">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- FORM LOGIN -->
        <form action="<?= site_url('login/auth'); ?>" method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <input type="text" name="username" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-semibold transition">
                Login
            </button>
        </form>

        <!-- REGISTER LINK -->
        <div class="text-center mt-5 text-sm text-gray-600">
            Belum punya akun?
            <a href="<?= base_url('login/register'); ?>" 
               class="text-blue-600 font-semibold hover:underline">
                Register di sini
            </a>
        </div>

    </div>

</body>
</html>
