<?php $this->load->view('template/header'); ?>

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

    <table class="w-full border-collapse border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Plat</th>
                <th class="border p-2">Jenis</th>
                <th class="border p-2">Member</th>
                <th class="border p-2">Waktu Masuk</th>
                <th class="border p-2">Waktu Keluar</th>
                <th class="border p-2">Durasi (Jam)</th>
                <th class="border p-2">Tarif</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($list)): ?>
            <tr>
                <td colspan="7" class="text-center p-4">
                    Belum ada transaksi keluar
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($list as $row): ?>
            <tr>
                <td class="border p-2"><?= $row->plat ?></td>
                <td class="border p-2"><?= $row->jenis_kendaraan ?></td>
                <td class="border p-2">
                    <?= $row->is_member ? 'Member' : 'Non Member' ?>
                </td>
                <td class="border p-2"><?= $row->waktu_masuk ?></td>
                <td class="border p-2"><?= $row->waktu_keluar ?></td>
                <td class="border p-2 text-center"><?= $row->durasi ?></td>
                <td class="border p-2">
                    Rp <?= number_format($row->tarif, 0, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('template/footer'); ?>
