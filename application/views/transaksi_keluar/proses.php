<?php $this->load->view('template/header'); ?>

<div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-4"><?php echo $title; ?></h1>

    <?php if ($this->session->flashdata('error')): ?>
    <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:6px;margin-bottom:15px;">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>


    <form method="post" action="<?php echo site_url('transaksi_keluar/simpan'); ?>">

        <input type="hidden" name="id_masuk" value="<?php echo $masuk->id_masuk; ?>">

        <!-- PLAT -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Plat Kendaraan</label>
            <input type="text"
                   value="<?php echo $masuk->plat; ?>"
                   class="w-full border rounded p-2 bg-gray-100"
                   readonly>
        </div>

        <!-- JENIS KENDARAAN -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Jenis Kendaraan</label>
            <input type="text"
                   value="<?php echo $masuk->jenis_kendaraan; ?>"
                   class="w-full border rounded p-2 bg-gray-100"
                   readonly>
        </div>

        <!-- JENIS KENDARAAN (HIDDEN UNTUK JS) -->
        <input type="hidden" id="jenis_kendaraan" value="<?php echo $masuk->jenis_kendaraan; ?>">

        <!-- WAKTU MASUK -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Waktu Masuk</label>
            <input type="text"
                   id="waktu_masuk"
                   value="<?php echo $masuk->waktu_masuk; ?>"
                   class="w-full border rounded p-2 bg-gray-100"
                   readonly>
        </div>

        <!-- WAKTU KELUAR -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Waktu Keluar</label>
            <input type="datetime-local"
                   name="waktu_keluar"
                   id="waktu_keluar"
                   required
                   class="w-full border rounded p-2">
        </div>

        <!-- STATUS MEMBER -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Status Member</label>
            <input type="text"
                   id="status_member"
                   value="<?php echo ($masuk->is_member == 1) ? 'MEMBER (Diskon 50%)' : 'Non Member'; ?>"
                   class="w-full border rounded p-2 bg-gray-100"
                   readonly>
        </div>

        <!-- INFO LOGIC -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Kategori Hari</label>
            <input type="text"
                   id="kategori_hari"
                   class="w-full border rounded p-2 bg-gray-100"
                   readonly>
        </div>

        <!-- INFO LIVE -->
        <div class="mb-6 p-4 bg-gray-50 border rounded">
            <div class="mb-2">
                <strong>Durasi Parkir:</strong>
                <span id="durasi">0</span> jam
            </div>
            <div>
                <strong>Total Tarif:</strong>
                <span id="tarif">Rp 0</span>
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex gap-3">
            <button type="submit"
                    class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                Simpan
            </button>

            <a href="<?php echo site_url('transaksi_keluar'); ?>"
               class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                Batal
            </a>
        </div>

    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputKeluar = document.getElementById('waktu_keluar');
    const waktuMasuk  = new Date(
        document.getElementById('waktu_masuk').value.replace(' ', 'T')
    );

    const jenis    = document.getElementById('jenis_kendaraan').value;
    const isMember = document.getElementById('status_member').value.includes('MEMBER');

    function setNow() {
        const now = new Date();
        const offset = now.getTimezoneOffset() * 60000;
        inputKeluar.value = new Date(now - offset).toISOString().slice(0,16);
        hitung();
    }

    function hitung() {
        if (!inputKeluar.value) return;

        const keluar = new Date(inputKeluar.value);

        if (keluar <= waktuMasuk) {
            document.getElementById('durasi').innerText = '0';
            document.getElementById('tarif').innerText  = 'Rp 0';
            document.getElementById('kategori_hari').value = '-';
            return;
        }

        const durasi = Math.ceil((keluar - waktuMasuk) / (1000 * 60 * 60));
        const hari = keluar.getDay();
        const isWeekend = (hari === 0 || hari === 6);

        document.getElementById('kategori_hari').value =
            isWeekend ? 'Weekend' : 'Weekday';

        let tarifPerJam = 0;
        if (jenis === 'Motor') {
            tarifPerJam = isWeekend ? 7000 : 5000;
        } else {
            tarifPerJam = isWeekend ? 15000 : 10000;
        }

        let total = tarifPerJam * durasi;

        if (isMember) {
            total = total * 0.5;
        }

        document.getElementById('durasi').innerText = durasi;
        document.getElementById('tarif').innerText =
            'Rp ' + total.toLocaleString('id-ID');
    }

    setNow();
    inputKeluar.addEventListener('input', hitung);
});
</script>

<?php $this->load->view('template/footer'); ?>
