<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;


class Admin extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesananmasuk');
        
    }
    
    public function index()
    {
        
        $data = array(
            'title' => 'Dashboard',
            'totalbarang' => $this->m_admin->totalbarang(),
            'totalbarangadmin' => $this->m_admin->totalbarang_admin(),
            'totalpm' => $this->m_admin->totalpm(),
            'totalpmadmin' => $this->m_admin->totalpm_admin(),
            'totalkategori' => $this->m_admin->totalkategori(), 
            'totalpelanggan' => $this->m_admin->totalpelanggan(),
            'isi' => 'v_admin'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
     
    }

    public function setting()
    {
        $this->user_login->admin();
        $id_user = $this->session->userdata('id_user');
        $this->form_validation->set_rules('nama_user', 'Nama Toko', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Setting',
                'setting' => $this->m_admin->data_setting($id_user),
                'isi' => 'v_setting'
         );
         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else { 
            $data = array(
                'id_user' => $id_user,
                'lokasi' => $this->input->post('kota'),
                'nama_user' => $this->input->post('nama_user'),
                'alamat' => $this->input->post('alamat'),
                'no_telpon' => $this->input->post('no_telpon'),
                'nama_bank' => $this->input->post('nama_bank'),
                'atas_nama' => $this->input->post('atas_nama'),
                'no_rek' => $this->input->post('no_rek'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
            );
            $this->m_admin->update($data);
            $this->session->set_flashdata('pesan', 'Berhasil Diubah');
            redirect('admin/setting');
        }
    }

    public function pesanan_masuk()
    {
        if ($this->session->userdata('id_user') == "1")
        {
            $data = array( 
                'title' => 'Pesanan Masuk',
                'pesanan' => $this->m_pesananmasuk->pesanansuperadmin(),
                //'pesanan_diproses' => $this->m_pesananmasuk->pesanan_diprosessuperadmin(),
                //'pesanan_dikirim' => $this->m_pesananmasuk->pesanan_dikirimsuperadmin(),
                'pesanan_selesai' => $this->m_pesananmasuk->pesanan_selesaisuperadmin(),
                'isi' => 'v_pesanan_masuk_superadmin'
            );
        }else {
        $data = array( 
            'title' => 'Pesanan Masuk',
            'pesanan' => $this->m_pesananmasuk->pesanan(),
            'pesanan_diproses' => $this->m_pesananmasuk->pesanan_diproses(),
            'pesanan_dikirim' => $this->m_pesananmasuk->pesanan_dikirim(),
            'pesanan_selesai' => $this->m_pesananmasuk->pesanan_selesai(),
            'isi' => 'v_pesanan_masuk'
     );
    }
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }


    public function rincian_pesanan($id_transaksi)
    {
        
        
        $id = $this->m_pesananmasuk->rincipesanan($id_transaksi)->id_user;
        $order = $this->m_pesananmasuk->rincipesanan($id_transaksi)->no_order;
        $no_order = array('no_order' =>$order);
        
        //print_r($no_order);
        //die();
        $data = array( 
            'title' => 'Rinci Pesanan',
            'transaksi' => $this->m_pesananmasuk->rincipesanan($id_transaksi),
            'toko' => $this->m_pesananmasuk->rincitoko($id),
            'rinciorder' => $this->m_pesananmasuk->rinciorder($no_order),
            
            'isi' => 'v_rincian_pesanan'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function print($id_transaksi)
    {
        $id = $this->m_pesananmasuk->rincipesanan($id_transaksi)->id_user;
        $order = $this->m_pesananmasuk->rincipesanan($id_transaksi)->no_order;
        $no_order = array('no_order' =>$order);
        
        //print_r($no_order);
        //die();
        $data = array( 
            'title' => 'Rinci Pesanan',
            'transaksi' => $this->m_pesananmasuk->rincipesanan($id_transaksi),
            'toko' => $this->m_pesananmasuk->rincitoko($id),
            'rinciorder' => $this->m_pesananmasuk->rinciorder($no_order),
            
            'isi' => 'v_print.php'
     );
     $this->load->view('layout/v_wrapper_print', $data, FALSE);
    }



    public function proses($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '1',

        );
        $this->m_pesananmasuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan berhasil Diproses/Dikemas');
        redirect('admin/pesanan_masuk');
    }

    public function kirim($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '2',
            'no_resi' => $this->input->post('no_resi'),
            

        );
        $this->m_pesananmasuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan berhasil Kirim');
        redirect('admin/pesanan_masuk');
    }

    //QNA dan PENGADUAN

    public function qna()
    {
        $data = array(
            'title' => 'QnA?',
            'qna' => $this->m_admin->qna(),
            'isi' => 'v_adminqna'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function editqna( $id_qna)
    {
        $data = array(
            'id_qna' => $id_qna,
            'jawaban' => $this->input->post('jawaban'),
            

        );

        $this->m_admin->editqna($data);
        $this->session->set_flashdata('pesan', 'Berhasil Diubah');
        redirect('admin/qna');
    }

    public function hapusqna($id_qna)
    {
        $data = array('id_qna' => $id_qna );
        $this->m_admin->hapusqna($data);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('admin/qna');
    }

    ///

    public function pengaduan()
    {
        $data = array(
            'title' => 'QnA?',
            'pengaduan' => $this->m_admin->pengaduan(),
            'isi' => 'v_adminpengaduan'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function hapuspengaduan($id_pengaduan)
    {
        $data = array('id_pengaduan' => $id_pengaduan );
        $this->m_admin->hapuspengaduan($data);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('admin/pengaduan');
    }

    public function excel()
    {
        $idtoko = $this->session->userdata('id_user');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $data_transaksi = $this->m_pesananmasuk->listexcel($idtoko,$tgl_awal,$tgl_akhir)->result();
        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'N0')
        ->setCellValue('B1', 'NO. ORDER')
        ->setCellValue('C1', 'TANGGAL ORDER')
        ->setCellValue('D1', 'NAMA PENERIMA')
        ->setCellValue('E1', 'NOMOR HP')
        ->setCellValue('F1', 'PROVINSI PENERIMA')
        ->setCellValue('G1', 'KOTA PENERIMA')
        ->setCellValue('H1', 'ALAMAT PENERIMA')
        ->setCellValue('I1', 'KODE POS')
        ->setCellValue('J1', 'EKSPEDISI')
        ->setCellValue('K1', 'PAKET')
        ->setCellValue('L1', 'ESTIMASI')
        ->setCellValue('M1', 'ONGKIR')
        ->setCellValue('N1', 'BERAT')
        ->setCellValue('O1', 'GRAND TOTAL')
        ->setCellValue('P1', 'TOTAL BAYAR')
        ->setCellValue('Q1', 'TRANSAKSI ATAS NAMA')
        ->setCellValue('R1', 'NAMA BANK')
        ->setCellValue('S1', 'NO. REKENING')
        ->setCellValue('T1', 'NOMOR RESI');

        $baris = 2;
        $no = 1;
        foreach($data_transaksi as $pm) 
        {
            $spreadsheet->getActiveSheet()->setCellValue('A'.$baris, $no++)
                                        ->setCellValue('B'.$baris, $pm->no_order)
                                        ->setCellValue('C'.$baris, $pm->tgl_order)
                                        ->setCellValue('D'.$baris, $pm->nama_penerima)
                                        ->setCellValue('E'.$baris, $pm->hp_penerima)
                                        ->setCellValue('F'.$baris, $pm->provinsi)
                                        ->setCellValue('G'.$baris, $pm->kota)
                                        ->setCellValue('H'.$baris, $pm->alamat)
                                        ->setCellValue('I'.$baris, $pm->kode_pos)
                                        ->setCellValue('J'.$baris, $pm->ekspedisi)
                                        ->setCellValue('K'.$baris, $pm->paket)
                                        ->setCellValue('L'.$baris, $pm->estimasi)
                                        ->setCellValue('M'.$baris, $pm->ongkir)
                                        ->setCellValue('N'.$baris, $pm->berat)
                                        ->setCellValue('O'.$baris, $pm->grand_total)
                                        ->setCellValue('P'.$baris, $pm->total_bayar)
                                        ->setCellValue('Q'.$baris, $pm->atas_nama_pengguna)
                                        ->setCellValue('R'.$baris, $pm->nama_bank_pengguna)
                                        ->setCellValue('S'.$baris, $pm->no_rek_pengguna)
                                        ->setCellValue('T'.$baris, $pm->no_resi);
            $baris++;
        }
        $writer= new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan Penjualan BukaLapas.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }

    public function excelbukang()
    {
        $idtoko = $this->session->userdata('id_user');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        
        $data['pesananmasuk'] = $this->m_pesananmasuk->listexcel($idtoko,$tgl_awal,$tgl_akhir)->result();

        //print_r($data);
        //die();

        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();
        
        $object->getProperties()->setCreator("BukaLapas");
        $object->getProperties()->setLastModifiedBy("BukaLapas");
        $object->getProperties()->setTitle("Laporan Penjualan");

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->setCellValue('A1', 'N0');
        $object->getActiveSheet()->setCellValue('B1', 'NO. ORDER');
        $object->getActiveSheet()->setCellValue('C1', 'TANGGAL ORDER');
        $object->getActiveSheet()->setCellValue('D1', 'NAMA PENERIMA');
        $object->getActiveSheet()->setCellValue('E1', 'NOMOR HP');
        $object->getActiveSheet()->setCellValue('F1', 'PROVINSI PENERIMA');
        $object->getActiveSheet()->setCellValue('G1', 'KOTA PENERIMA');
        $object->getActiveSheet()->setCellValue('H1', 'ALAMAT PENERIMA');
        $object->getActiveSheet()->setCellValue('I1', 'KODE POS');
        $object->getActiveSheet()->setCellValue('J1', 'EKSPEDISI');
        $object->getActiveSheet()->setCellValue('K1', 'PAKET');
        $object->getActiveSheet()->setCellValue('L1', 'ESTIMASI');
        $object->getActiveSheet()->setCellValue('M1', 'ONGKIR');
        $object->getActiveSheet()->setCellValue('N1', 'BERAT');
        $object->getActiveSheet()->setCellValue('O1', 'GRAND TOTAL');
        $object->getActiveSheet()->setCellValue('P1', 'TOTAL BAYAR');

        $object->getActiveSheet()->setCellValue('Q1', 'TRANSAKSI ATAS NAMA');
        $object->getActiveSheet()->setCellValue('R1', 'NAMA BANK');
        $object->getActiveSheet()->setCellValue('S1', 'NO. REKENING');
        
        $object->getActiveSheet()->setCellValue('T1', 'NOMOR RESI');
        


        $baris = 2;
        $no=1;

        foreach ($data['pesananmasuk'] as $pm) {
            $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
            $object->getActiveSheet()->setCellValue('B'.$baris, $pm->no_order);
            $object->getActiveSheet()->setCellValue('C'.$baris, $pm->tgl_order);
            $object->getActiveSheet()->setCellValue('D'.$baris, $pm->nama_penerima);
            $object->getActiveSheet()->setCellValue('E'.$baris, $pm->hp_penerima);
            $object->getActiveSheet()->setCellValue('F'.$baris, $pm->provinsi);
            $object->getActiveSheet()->setCellValue('G'.$baris, $pm->kota);
            $object->getActiveSheet()->setCellValue('H'.$baris, $pm->alamat);
            $object->getActiveSheet()->setCellValue('I'.$baris, $pm->kode_pos);
            $object->getActiveSheet()->setCellValue('J'.$baris, $pm->ekspedisi);
            $object->getActiveSheet()->setCellValue('K'.$baris, $pm->paket);
            $object->getActiveSheet()->setCellValue('L'.$baris, $pm->estimasi);
            $object->getActiveSheet()->setCellValue('M'.$baris, $pm->ongkir);
            $object->getActiveSheet()->setCellValue('N'.$baris, $pm->berat);
            $object->getActiveSheet()->setCellValue('O'.$baris, $pm->grand_total);
            $object->getActiveSheet()->setCellValue('P'.$baris, $pm->total_bayar);
            $object->getActiveSheet()->setCellValue('Q'.$baris, $pm->atas_nama_pengguna);
            $object->getActiveSheet()->setCellValue('R'.$baris, $pm->nama_bank_pengguna);
            $object->getActiveSheet()->setCellValue('S'.$baris, $pm->no_rek_pengguna);
            $object->getActiveSheet()->setCellValue('T'.$baris, $pm->no_resi);

            $baris++;
        }

        $filename= "Laporan Penjualan ".'.xlsx';
        $object->getActiveSheet()->setTitle("Laporan Penjualan");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;

    }

    public function mpdf()
    {
        
        $idtoko = $this->session->userdata('id_user');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $data['transaksi'] = $this->m_pesananmasuk->listpdf($idtoko,$tgl_awal,$tgl_akhir)->result();
        
        //require_once __DIR__.'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf(['orientation'=> 'L']);
        $laporan = $this->load->view('v_pdfpenjualan', $data, true);
        $mpdf->WriteHTML($laporan);
        $mpdf->Output();
    }

    public function pdf()
	{
        $idtoko = $this->session->userdata('id_user');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        
        $data['transaksi'] = $this->m_pesananmasuk->listpdf($idtoko,$tgl_awal,$tgl_akhir)->result();

        //$this->load->view('v_pdfpenjualan', $data);

        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename= "Laporan Penjualan BukaLapas.pdf";
        $this->pdf->load_view('v_pdfpenjualan', $data);
        
    }

    public function pdfphp()
    {
        $idtoko = $this->session->userdata('id_user');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        //$spreadsheet= new Spreadsheet();
        $data['transaksi'] = $this->m_pesananmasuk->listpdf($idtoko,$tgl_awal,$tgl_akhir)->result();

        $spreadsheet= new Spreadsheet();
        $spreadsheet= $this->load->view('v_pdfpenjualan', $data);
        

        $writer = new Mpdf($spreadsheet);
        $writer->save("Laporan Penjualan BukaLapas.pdf");



    }

}

/* End of file Home.php */
