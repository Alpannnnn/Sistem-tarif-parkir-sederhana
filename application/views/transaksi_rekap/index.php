<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Rekap Transaksi Parkir</h1>

    <!-- Filter Tanggal -->
    <form action="<?= base_url('transaksi_rekap/filter') ?>" method="POST" class="mb-4">
        <div class="flex items-center gap-2">
            <input type="date" name="tanggal" value="<?= $tanggal ?>" 
                   class="border rounded p-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    <!-- Tabel Rekap -->
    <div class="bg-white shadow rounded p-4">
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Plat</th>
                    <th class="p-2 border">Jenis</th>
                    <th class="p-2 border">Jam Masuk</th>
                    <th class="p-2 border">Jam Keluar</th>
                    <th class="p-2 border">Durasi (jam)</th>
                    <th class="p-2 border">Biaya</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rekap): ?>
                    <?php foreach ($rekap as $r): ?>
                        <tr>
                            <td class="p-2 border"><?= $r->plat ?></td>
                            <td class="p-2 border"><?= $r->jenis ?></td>
                            <td class="p-2 border"><?= $r->jam_masuk ?></td>
                            <td class="p-2 border"><?= $r->jam_keluar ?></td>
                            <td class="p-2 border text-center"><?= $r->durasi ?></td>
                            <td class="p-2 border">Rp <?= number_format($r->biaya) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500 border">
                            Tidak ada transaksi pada tanggal ini
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
