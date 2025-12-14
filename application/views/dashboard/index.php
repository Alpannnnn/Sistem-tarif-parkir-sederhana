<div class="p-6 bg-gray-100 min-h-screen">

    <!-- JUDUL -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Sistem Parkir</h1>
        <p class="text-gray-500 mt-1">Ringkasan aktivitas parkir hari ini</p>
    </div>

    <!-- CARD STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-blue-600 text-white p-6 rounded-xl shadow-lg">
            <h2 class="text-sm uppercase tracking-wide">Kendaraan Terdaftar</h2>
            <p class="text-4xl font-bold mt-4"><?= $total_kendaraan ?></p>
        </div>

        <div class="bg-green-600 text-white p-6 rounded-xl shadow-lg">
            <h2 class="text-sm uppercase tracking-wide">Transaksi Hari Ini</h2>
            <p class="text-4xl font-bold mt-4"><?= $total_transaksi_hari_ini ?></p>
        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-xl shadow-lg">
            <h2 class="text-sm uppercase tracking-wide">Pendapatan Hari Ini</h2>
            <p class="text-3xl font-bold mt-4">
                Rp <?= number_format($total_pendapatan_hari_ini) ?>
            </p>
        </div>

        <div class="bg-purple-600 text-white p-6 rounded-xl shadow-lg">
            <h2 class="text-sm uppercase tracking-wide">Total Operator</h2>
            <p class="text-4xl font-bold mt-4"><?= $total_operator ?></p>
        </div>

    </div>

    <!-- DETAIL HARI INI -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">

        <div class="bg-white p-8 rounded-xl shadow border">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">
                Kendaraan Masuk Hari Ini
            </h2>
            <p class="text-5xl font-bold text-blue-600"><?= $kendaraan_masuk ?></p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow border">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">
                Kendaraan Keluar Hari Ini
            </h2>
            <p class="text-5xl font-bold text-green-600"><?= $kendaraan_keluar ?></p>
        </div>

    </div>

    <!-- TARIF PARKIR -->
    <div class="mb-14">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            Tarif Parkir
        </h2>

        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-4xl">
            <p class="text-gray-500 mb-4 text-lg">
                Tarif parkir berlaku per jam
            </p>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-4 px-4 text-left text-lg">Jenis Kendaraan</th>
                            <th class="py-4 px-4 text-left text-lg">Tarif Weekday</th>
                            <th class="py-4 px-4 text-left text-lg">Tarif Weekend</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">

                        <tr class="border-t">
                            <td class="py-4 px-4 font-semibold">Motor</td>
                            <td class="py-4 px-4">Rp 5.000 / jam</td>
                            <td class="py-4 px-4">Rp 7.000 / jam</td>
                        </tr>

                        <tr class="border-t">
                            <td class="py-4 px-4 font-semibold">Mobil</td>
                            <td class="py-4 px-4">Rp 10.000 / jam</td>
                            <td class="py-4 px-4">Rp 15.000 / jam</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MENU CEPAT -->
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Menu Cepat</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="<?= base_url('transaksi_masuk') ?>"
           class="flex items-center justify-center gap-2 bg-blue-500 text-white p-6 rounded-xl shadow font-semibold hover:bg-blue-600 transition">
            ➕ Transaksi Masuk
        </a>

        <a href="<?= base_url('transaksi_keluar') ?>"
           class="flex items-center justify-center gap-2 bg-green-500 text-white p-6 rounded-xl shadow font-semibold hover:bg-green-600 transition">
            🚗 Transaksi Keluar
        </a>

        <a href="<?= base_url('transaksi_rekap') ?>"
           class="flex items-center justify-center gap-2 bg-gray-700 text-white p-6 rounded-xl shadow font-semibold hover:bg-gray-900 transition">
            📄 Rekap Transaksi
        </a>

        <a href="<?= base_url('master_kendaraan') ?>"
           class="flex items-center justify-center gap-2 bg-indigo-500 text-white p-6 rounded-xl shadow font-semibold hover:bg-indigo-600 transition">
            🚙 Data Kendaraan
        </a>

        <a href="<?= base_url('area_parkir') ?>"
           class="flex items-center justify-center gap-2 bg-teal-500 text-white p-6 rounded-xl shadow font-semibold hover:bg-teal-600 transition">
            🅿️ Area Parkir
        </a>

        <a href="<?= base_url('laporan') ?>"
           class="flex items-center justify-center gap-2 bg-red-500 text-white p-6 rounded-xl shadow font-semibold hover:bg-red-600 transition">
            📊 Laporan Parkir
        </a>

    </div>

</div>
