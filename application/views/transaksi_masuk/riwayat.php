<?php $this->load->view('template/header'); ?>

<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Transaksi Masuk
        </h1>

        <a href="<?= base_url('dashboard') ?>"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            ← Kembali ke Dashboard
        </a>
    </div>

    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Plat</th>
                <th class="p-3 text-left">Area</th>
                <th class="p-3 text-left">Waktu Masuk</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
        <?php if (empty($list)): ?>
            <tr>
                <td colspan="4" class="p-6 text-center text-gray-500">
                    Belum ada riwayat transaksi masuk
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($list as $l): ?>
                <tr class="border-t">
                    <td class="p-3 font-semibold uppercase">
                        <?= $l->plat ?>
                    </td>

                    <td class="p-3">
                        <?= $l->area == 'A' ? 'Rooftop' : 'Basement' ?>
                    </td>

                    <td class="p-3">
                        <?= date('d-m-Y H:i', strtotime($l->waktu_masuk)) ?>
                    </td>

                    <td class="p-3">
                        <?php if ($l->status === 'IN'): ?>
                            <span class="text-green-600 font-semibold">IN</span>
                        <?php else: ?>
                            <span class="text-red-600 font-semibold">OUT</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>

    </table>

</div>

<?php $this->load->view('template/footer'); ?>
