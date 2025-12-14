<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th>Plat</th>
            <th>Jenis</th>
            <th>Area</th>
            <th>Waktu Masuk</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $t): ?>
        <tr>
            <td><?= $t->plat ?></td>
            <td><?= $t->jenis ?></td>
            <td><?= $t->nama_area ?></td>
            <td><?= $t->waktu_masuk ?></td>
            <td>
                <?php if ($t->status == 'IN'): ?>
                    <span class="text-green-600 font-bold">IN</span>
                <?php else: ?>
                    <span class="text-red-600 font-bold">OUT</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
