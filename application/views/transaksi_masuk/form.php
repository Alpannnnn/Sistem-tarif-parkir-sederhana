<?php $this->load->view('template/header'); ?>

<div class="max-w-xl bg-white p-6 rounded-xl shadow">

<h1 class="text-2xl font-bold mb-6"><?= $title ?></h1>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var input = document.querySelector('input[type="datetime-local"]');
    if (!input) return;

    var now = new Date();
    var offset = now.getTimezoneOffset() * 60000;
    input.value = new Date(now - offset).toISOString().slice(0,16);
});
</script>

<?php if ($this->session->flashdata('error')): ?>
<div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
    <?= $this->session->flashdata('error') ?>
</div>
<?php endif; ?>

<form action="<?= base_url('transaksi_masuk/simpan') ?>" method="post">

    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Plat Kendaraan</label>
        <input type="text"
               name="plat"
               required
               class="w-full border px-3 py-2 rounded uppercase">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Area Parkir</label>
        <select name="area" required class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Area --</option>
            <option value="A">Rooftop</option>
            <option value="B">Basement</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Waktu Masuk</label>
        <input type="datetime-local"
               name="waktu_masuk"
               required
               class="w-full border px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required class="w-full border px-3 py-2 rounded">
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
        </select>
    </div>

    <div class="mb-6 flex items-center gap-2">
        <input type="checkbox" name="is_member" value="1">
        <label class="text-sm">Member</label>
    </div>

    <div class="flex justify-between">
        <a href="<?= base_url('transaksi_masuk') ?>"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg">
            Batal
        </a>

        <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded-lg">
            Simpan
        </button>
    </div>

</form>
</div>

<?php $this->load->view('template/footer'); ?>
