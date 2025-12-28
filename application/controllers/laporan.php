<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->library('session');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
    $id_operator = $this->session->userdata('id_operator');

    $data['title'] = 'Laporan Parkir';
    $data['ringkasan'] =
        $this->Laporan_model
        ->ringkasan_hari_ini_by_operator($id_operator);

    $this->load->view('laporan/index', $data);
    }


    // ===============================
    // LAPORAN KENDARAAN
    // ===============================
    public function kendaraan()
    {
        $id_operator = $this->session->userdata('id_operator');

        $tanggal = $this->input->get('tanggal');
        if (!$tanggal) {
            $tanggal = date('Y-m-d');
        }

        $bulan = $this->input->get('bulan');
        if (!$bulan) {
            $bulan = date('m');
        }

        $data['title']   = 'Laporan Kendaraan';
        $data['tanggal'] = $tanggal;
        $data['bulan']   = $bulan;

        $data['harian']  = $this->Laporan_model
            ->lap_kendaraan_harian($tanggal, $id_operator);

        $data['bulanan'] = $this->Laporan_model
            ->lap_kendaraan_bulanan($bulan, $id_operator);

        $this->load->view('laporan/kendaraan', $data);
    }

    // ===============================
    // LAPORAN TRANSAKSI / PENDAPATAN
    // ===============================
    public function transaksi()
    {
        $id_operator = $this->session->userdata('id_operator');

        $tanggal = $this->input->get('tanggal');
        if (!$tanggal) {
            $tanggal = date('Y-m-d');
        }

        $bulan = $this->input->get('bulan');
        if (!$bulan) {
            $bulan = date('m');
        }

        $data['title']   = 'Laporan Transaksi';
        $data['tanggal'] = $tanggal;
        $data['bulan']   = $bulan;

        $data['harian']  = $this->Laporan_model
            ->lap_transaksi_harian($tanggal, $id_operator);

        $data['bulanan'] = $this->Laporan_model
            ->lap_transaksi_bulanan($bulan, $id_operator);

        $this->load->view('laporan/transaksi', $data);
    }

    // ===============================
    // LAPORAN OPERATOR (ADMIN)
    // ===============================
    public function operator()
    {
        $tanggal = $this->input->get('tanggal');
        if (!$tanggal) {
            $tanggal = date('Y-m-d');
        }

        $data['title']   = 'Laporan Operator';
        $data['tanggal'] = $tanggal;

        $data['lap_operator'] =
            $this->Laporan_model->lap_operator_harian($tanggal);

        $this->load->view('laporan/operator', $data);
    }


public function export_transaksi_pdf()
{
    $id_operator = $this->session->userdata('id_operator');
    $tanggal = $this->input->get('tanggal') ?? date('Y-m-d');
    $bulan   = $this->input->get('bulan');

    if ($bulan) {
        $data['title'] = 'Laporan Transaksi Bulanan';
        $data['list']  = $this->Laporan_model
            ->lap_transaksi_bulanan_detail($bulan, $id_operator);
    } else {
        $data['title'] = 'Laporan Transaksi Harian';
        $data['list']  = $this->Laporan_model
            ->lap_transaksi_harian_detail($tanggal, $id_operator);
    }

    $data['operator'] = $this->session->userdata('nama_operator');

    $html = $this->load->view('laporan/export_transaksi_pdf', $data, true);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => false]);
    }

    public function export_transaksi_excel()
{
    $id_operator = $this->session->userdata('id_operator');
    $tanggal = $this->input->get('tanggal') ?? date('Y-m-d');

    $list = $this->Laporan_model
        ->lap_transaksi_harian_detail($tanggal, $id_operator);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // HEADER
    $sheet->setCellValue('A1', 'Laporan Transaksi Harian');
    $sheet->setCellValue('A2', 'Operator: ' . $this->session->userdata('nama_operator'));
    $sheet->setCellValue('A3', 'Tanggal: ' . $tanggal);

    // TABLE HEADER
    $sheet->fromArray([
        ['Plat', 'Area', 'Masuk', 'Keluar', 'Durasi (Jam)', 'Tarif']
    ], null, 'A5');

    $row = 6;
    foreach ($list as $l) {
        $sheet->fromArray([
            $l->plat,
            $l->area == 'A' ? 'Rooftop' : 'Basement',
            $l->waktu_masuk,
            $l->waktu_keluar,
            $l->durasi,
            $l->tarif
        ], null, 'A'.$row++);
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="laporan_transaksi.xlsx"');
    $writer->save('php://output');
    }



}
