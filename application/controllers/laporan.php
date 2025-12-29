<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Operator_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    // =======================
    // HALAMAN LAPORAN
    // =======================
    public function index()
    {
        $data['title'] = 'Laporan Transaksi';

        $filter = array();

        // FILTER TANGGAL (YYYY-MM-DD)
        if ($this->input->get('tanggal')) {
            $filter['tanggal'] = $this->input->get('tanggal');
        }

        // FILTER BULAN (YYYY-MM)
        if ($this->input->get('bulan')) {
            $filter['bulan'] = $this->input->get('bulan');
        }

        // ROLE
        if ($this->session->userdata('role') !== 'admin') {
            $filter['id_operator'] = $this->session->userdata('id_operator');
        } else {
            if ($this->input->get('id_operator')) {
                $filter['id_operator'] = $this->input->get('id_operator');
            }
        }

        $data['filter']    = $filter;
        $data['laporan']   = $this->Laporan_model->get_laporan($filter);
        $data['ringkasan'] = $this->Laporan_model->get_ringkasan($filter);
        $data['operators'] = $this->Operator_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer');
    }

    // =======================
    // EXPORT PDF (PREVIEW)
    // =======================
    public function export_pdf()
    {
        // 🔥 BERSIHKAN SEMUA OUTPUT BUFFER
        while (ob_get_level()) {
            ob_end_clean();
        }

        $filter = array();

        if ($this->input->get('tanggal')) {
            $filter['tanggal'] = $this->input->get('tanggal');
        }

        if ($this->input->get('bulan')) {
            $filter['bulan'] = $this->input->get('bulan');
        }

        if ($this->session->userdata('role') !== 'admin') {
            $filter['id_operator'] = $this->session->userdata('id_operator');
        }

        $data['laporan']   = $this->Laporan_model->get_laporan($filter);
        $data['ringkasan'] = $this->Laporan_model->get_ringkasan($filter);
        $data['filter']    = $filter;

        // LOAD HTML DARI VIEW
        $html = $this->load->view('laporan/pdf_template', $data, true);

        // LOAD LIBRARY PDF
        $this->load->library('pdf');

        // 🔥 PREVIEW PDF (INLINE)
        $this->pdf->createPDF(
            $html,
            'Laporan_Parkir.pdf',
            'A4',
            'landscape'
        );

        exit;
    }

    // =======================
    // EXPORT EXCEL
    // =======================
public function export_excel()
{
    $filter = array();

    if ($this->input->get('tanggal')) {
        $filter['tanggal'] = $this->input->get('tanggal');
    }

    if ($this->input->get('bulan')) {
        $filter['bulan'] = $this->input->get('bulan');
    }

    if ($this->session->userdata('role') !== 'admin') {
        $filter['id_operator'] = $this->session->userdata('id_operator');
    }

    $laporan   = $this->Laporan_model->get_laporan($filter);
    $ringkasan = $this->Laporan_model->get_ringkasan($filter);

    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=laporan_parkir.csv");
    echo "\xEF\xBB\xBF";
    
    $out = fopen("php://output", "w");
    
    fputcsv($out, array(
        'No', 'Plat', 'Jenis Kendaraan', 'Operator',
        'Waktu Masuk', 'Waktu Keluar', 'Durasi', 'Tarif', 'Member'
    ), ';');
    
    $no = 1;
    foreach ($laporan as $row) {
        fputcsv($out, array(
            $no++,
            $row->plat,
            $row->jenis_kendaraan,
            $row->operator_nama,
            $row->waktu_masuk,
            $row->waktu_keluar,
            $row->durasi,
            'Rp ' . number_format($row->tarif, 0, ',', '.'),
            $row->is_member == 1 ? 'Ya' : 'Tidak'
        ), ';');
    }
    
    fputcsv($out, array(), ';');
    fputcsv($out, array('RINGKASAN'), ';');
    fputcsv($out, array(
        '', '', '', '', '', '', 
        'Total Transaksi', 
        $ringkasan->total_transaksi
    ), ';');
    fputcsv($out, array(
        '', '', '', '', '', '', 
        'Total Motor', 
        $ringkasan->total_motor
    ), ';');
    fputcsv($out, array(
        '', '', '', '', '', '', 
        'Total Mobil', 
        $ringkasan->total_mobil
    ), ';');
    fputcsv($out, array(
        '', '', '', '', '', '', 
        'Total Member', 
        $ringkasan->total_member
    ), ';');
    fputcsv($out, array(
        '', '', '', '', '', '', 
        'Total Durasi', 
        $ringkasan->total_durasi . ' menit'
    ), ';');
    fputcsv($out, array(
        '', '', '', '', '', '', 
        'Total Pendapatan', 
        'Rp ' . number_format($ringkasan->total_pendapatan, 0, ',', '.')
    ), ';');
    
    fclose($out);
    exit;
}
}
