<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Sistem Parkir' ?></title>

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

<body class="bg-gray-100 font-sans">

<nav class="bg-white shadow-md border-b sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- BRAND -->
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white font-bold rounded-lg px-3 py-1 text-lg">
                    🅿️
                </div>
                <span class="font-bold text-xl text-gray-800">
                    Sistem Parkir
                </span>
            </div>

            <!-- MENU -->
            <div class="hidden md:flex items-center gap-6 font-medium text-gray-600">
                <a href="<?= base_url('dashboard') ?>" class="hover:text-blue-600">Dashboard</a>
                <a href="<?= base_url('transaksi_masuk') ?>" class="hover:text-blue-600">Transaksi Masuk</a>
                <a href="<?= base_url('transaksi_keluar') ?>" class="hover:text-blue-600">Transaksi Keluar</a>
                <a href="<?= base_url('laporan') ?>" class="hover:text-blue-600">Laporan</a>
            </div>

            <!-- USER -->
            <div class="flex items-center gap-4">

                <?php
                    $nama = $this->session->userdata('nama_operator');
                    if (!$nama) {
                        $nama = 'Operator';
                    }
                ?>

                <div class="hidden sm:block text-right">
                    <p class="text-sm font-semibold text-gray-800">
                        <?= $nama ?>
                    </p>
                    <p class="text-xs text-gray-500">Operator</p>
                </div>

                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold">
                    <?= strtoupper(substr($nama, 0, 1)) ?>
                </div>

                <a href="<?= base_url('auth/logout') ?>"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                    Logout
                </a>


            </div>

        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-6">
