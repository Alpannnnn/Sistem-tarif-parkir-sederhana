<?php $this->load->view('template/header'); ?>

<div class="max-w-7xl mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        <?= $title ?>
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- BASEMENT -->
        <div class="bg-white p-6 rounded-xl shadow flex flex-col">
            <span class="text-gray-500 text-sm mb-2">Basement</span>
            <span class="text-4xl font-bold text-blue-600">
                <?= $ringkasan['basement'] ?>
            </span>
            <span class="text-sm text-gray-400 mt-1">Kendaraan</span>
        </div>

        <!-- ROOFTOP -->
        <div class="bg-white p-6 rounded-xl shadow flex flex-col">
            <span class="text-gray-500 text-sm mb-2">Rooftop</span>
            <span class="text-4xl font-bold text-green-600">
                <?= $ringkasan['rooftop'] ?>
            </span>
            <span class="text-sm text-gray-400 mt-1">Kendaraan</span>
        </div>

        <!-- TOTAL -->
        <div class="bg-white p-6 rounded-xl shadow flex flex-col">
            <span class="text-gray-500 text-sm mb-2">Total Parkir</span>
            <span class="text-4xl font-bold text-gray-800">
                <?= $ringkasan['total'] ?>
            </span>
            <span class="text-sm text-gray-400 mt-1">Kendaraan Aktif</span>
        </div>

        <!-- PENDAPATAN -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-500 text-white p-6 rounded-xl shadow flex flex-col">
            <span class="text-sm opacity-90 mb-2">Pendapatan Hari Ini</span>
            <span class="text-3xl font-bold">
                Rp <?= number_format($ringkasan['pendapatan'], 0, ',', '.') ?>
            </span>
            <span class="text-xs opacity-80 mt-1">Berdasarkan transaksi keluar</span>
        </div>

    </div>

</div>

<?php $this->load->view('template/footer'); ?>
