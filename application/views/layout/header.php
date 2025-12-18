<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Sistem Parkir' ?></title>

    <!-- Tailwind CDN (aman untuk UAS) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- NAVBAR -->
<nav class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">
    <div class="font-bold text-lg">
        🚗 Sistem Parkir
    </div>

    <div class="space-x-4 text-sm">
        <a href="<?= base_url('dashboard') ?>" class="hover:underline">Dashboard</a>
        <a href="<?= base_url('transaksi_masuk') ?>" class="hover:underline">Masuk</a>
        <a href="<?= base_url('transaksi_keluar') ?>" class="hover:underline">Keluar</a>
        <a href="<?= base_url('transaksi_keluar/riwayat') ?>" class="hover:underline">Riwayat</a>
        <a href="<?= base_url('auth/logout') ?>" class="text-red-400 hover:underline">Logout</a>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mx-auto px-6 py-6">

<?php if ($this->session->flashdata('error')) : ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= $this->session->flashdata('error') ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')) : ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif; ?>
