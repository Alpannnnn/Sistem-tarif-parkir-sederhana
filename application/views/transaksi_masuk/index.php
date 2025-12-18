<?php $this->load->view('template/header'); ?>

<div class="bg-white rounded-lg shadow p-6">

    <h2 class="text-xl font-bold mb-4">Transaksi Masuk</h2>

    <div class="mb-4 flex gap-2">
        <a href="<?php echo base_url('transaksi_masuk/tambah'); ?>"
           class="inline-block bg-green-600 text-white px-4 py-2 rounded">
            Tambah
        </a>

        <a href="<?php echo site_url('dashboard'); ?>"
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            ⬅ Dashboard
        </a>
    </div>

    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Plat</th>
            <th class="border px-3 py-2">Area</th>
            <th class="border px-3 py-2">Waktu Masuk</th>
            <th class="border px-3 py-2">Status</th>
        </tr>
        </thead>

        <tbody>
        <?php if (empty($list)): ?>
            <tr>
                <td colspan="4" class="text-center py-4 text-gray-500">
                    Tidak ada kendaraan parkir
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($list as $l): ?>
                <tr>
                    <td class="border px-3 py-2">
                        <?php echo htmlspecialchars($l->plat); ?>
                    </td>

                    <!-- ✅ AREA HARDCODE (A / B) -->
                    <td class="border px-3 py-2">
                        <?php
                        if (!empty($l->area) && isset($area_parkir[$l->area])) {
                            echo $area_parkir[$l->area];
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <td class="border px-3 py-2">
                        <?php echo $l->waktu_masuk; ?>
                    </td>

                    <td class="border px-3 py-2 text-green-600 font-semibold">
                        <?php echo strtoupper($l->status); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<?php $this->load->view('template/footer'); ?>
