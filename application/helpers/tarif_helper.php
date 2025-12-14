<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function hitung_tarif_keluar($jenis_kendaraan, $jam_masuk, $jam_keluar)
{
    // Tentukan weekday/weekend
    $hari = date('N', strtotime($jam_keluar)); 
    // 1 = Senin, 7 = Minggu

    $is_weekend = ($hari == 6 || $hari == 7);

    // Tarif Hardcode
    if ($jenis_kendaraan == 'motor') {
        $tarif = $is_weekend ? 7000 : 5000;
    } 
    elseif ($jenis_kendaraan == 'mobil') {
        $tarif = $is_weekend ? 15000 : 10000;
    } 
    else {
        // default (jika jenis tidak dikenal)
        $tarif = 0;
    }

    // Opsional: Jika ingin hitung durasi (jam) bisa ditambah nanti
    return $tarif;
}
