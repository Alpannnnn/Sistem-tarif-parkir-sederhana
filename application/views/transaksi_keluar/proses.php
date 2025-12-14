<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4"><?= $title ?></h1>

    <form method="post" action="<?= site_url('transaksi_keluar/simpan') ?>">

        <input type="hidden" name="id_masuk" value="<?= $masuk->id_masuk ?>">
        <input type="hidden" name="durasi" id="durasi">

        <!-- DATA -->
        <p><strong>Plat:</strong> <?= $masuk->plat ?></p>
        <p><strong>Jenis:</strong> <?= $master_kendaraan->jenis ?></p>
        <p><strong>Waktu Masuk:</strong> <?= $masuk->waktu_masuk ?></p>

        <!-- SIMPAN KE JS -->
        <input type="hidden" id="waktu_masuk" value="<?= $masuk->waktu_masuk ?>">
        <input type="hidden" id="jenis" value="<?= $master_kendaraan->jenis ?>">

        <hr class="my-4">

        <!-- INPUT MANUAL -->
        <label class="font-semibold">Waktu Keluar</label>
        <input type="datetime-local"
               name="waktu_keluar"
               id="waktu_keluar"
               class="w-full p-2 border rounded mb-4"
               required>

        <!-- HASIL -->
        <p><strong>Tarif / Jam:</strong> Rp <span id="tarif">0</span></p>
        <p><strong>Durasi:</strong> <span id="durasi_text">0</span> Jam</p>

        <label class="font-semibold mt-2 block">Total Biaya</label>
        <input type="text"
               name="total_biaya"
               id="total_biaya"
               class="w-full p-2 border rounded mb-4"
               readonly>

        <button class="px-4 py-2 bg-green-600 text-white rounded">
            Simpan
        </button>

        <a href="<?= site_url('transaksi_keluar') ?>"
           class="px-4 py-2 ml-2 bg-gray-500 text-white rounded">
            Kembali
        </a>

    </form>

</div>

<!-- 🔥 SCRIPT HITUNG OTOMATIS -->
<script>
document.getElementById('waktu_keluar').addEventListener('change', hitungBiaya);

function hitungBiaya() {

    const masuk = new Date(document.getElementById('waktu_masuk').value);
    const keluar = new Date(document.getElementById('waktu_keluar').value);
    const jenis = document.getElementById('jenis').value;

    // validasi waktu
    if (keluar <= masuk) {
        alert('Waktu keluar harus lebih besar dari waktu masuk');
        return;
    }

    // hitung durasi
    const selisihMs = keluar - masuk;
    const durasi = Math.ceil(selisihMs / (1000 * 60 * 60));

    // weekend?
    const hari = keluar.getDay(); // 0 minggu
    const weekend = (hari === 0 || hari === 6);

    let tarif = 0;
    if (jenis === 'Motor') {
        tarif = weekend ? 7000 : 5000;
    } else {
        tarif = weekend ? 15000 : 10000;
    }

    const total = durasi * tarif;

    // tampilkan
    document.getElementById('tarif').innerText = tarif.toLocaleString();
    document.getElementById('durasi_text').innerText = durasi;
    document.getElementById('durasi').value = durasi;
    document.getElementById('total_biaya').value = total;
}
</script>

</body>
</html>
