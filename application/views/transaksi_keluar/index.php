<?php $this->load->view('template/header'); ?>

<div class="max-w-5xl mx-auto bg-white p-6 shadow rounded">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">
            <?php echo $title; ?>
        </h1>

        <a href="<?php echo site_url('dashboard'); ?>"
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            ⬅ Dashboard
        </a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2">Plat</th>
                <th class="p-2">Area</th>
                <th class="p-2">Waktu Masuk</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if (empty($list)): ?>
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">
                    Tidak ada kendaraan parkir saat ini
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($list as $l): ?>
            <tr class="border-t">
                <td class="p-2 font-semibold">
                    <?php echo $l->plat; ?>
                </td>

                <!-- AREA HARDCODE (AMAN PHP 5) -->
                <td class="p-2">
                    <?php
                        if (isset($area_parkir[$l->area])) {
                            echo $area_parkir[$l->area];
                        } else {
                            echo '-';
                        }
                    ?>
                </td>

                <td class="p-2">
                    <?php echo $l->waktu_masuk; ?>
                </td>

                <td class="p-2 text-green-600 font-bold">
                    <?php echo $l->status; ?>
                </td>

                <td class="p-2">
                    <a href="<?php echo site_url('transaksi_keluar/proses/'.$l->id_masuk); ?>"
                       class="px-3 py-1 bg-blue-600 text-white rounded">
                        Proses
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<?php $this->load->view('template/footer'); ?>
