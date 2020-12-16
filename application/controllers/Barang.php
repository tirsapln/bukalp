<?php


defined('BASEPATH') OR exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');

    }

    // List all your items
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        if ($id_user=="1") {
            $data = array(
                'title' => 'Barang',
                'barang' => $this->m_barang->listsuperadmin(),
                'isi' => 'barang/v_barang'
            );
        } else {
            $data = array(
                'title' => 'Barang',
                'barang' => $this->m_barang->list(),
                'isi' => 'barang/v_barang'
            );
        }
        
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('berat', 'Berat', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        $id_user = $this->session->userdata('id_user');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|ico';
            $config['max_size']     = '8000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Tambah Data',
                    'kategori' => $this->m_kategori->list(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'barang/v_add'
             );
             $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            }
            else
            {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nama_barang' => $this->input->post('nama_barang'), 
                    'id_kategori' => $this->input->post('id_kategori'),
                    'harga' => $this->input->post('harga'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                    'berat' => $this->input->post('berat'),
                    'stok' => $this->input->post('stok'),
                    'id_user' => $id_user,
                    
                );
                $this->m_barang->add($data);
                $this->session->set_flashdata('pesan', 'Berhasil Ditambahkan');
                redirect('barang');

            }
            
        } 
        
        $data = array(
            'title' => 'Tambah Data',
            'kategori' => $this->m_kategori->list(),
            'isi' => 'barang/v_add'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Update one item
    public function edit( $id_barang )
    {
        $this->user_login->admin();
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        $this->form_validation->set_rules('berat', 'Berat', 'required', array('required' =>'%s Harus Diisi!!!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' =>'%s Harus Diisi!!!'));
        
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|ico';
            $config['max_size']     = '8000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Ubah Data',
                    'kategori' => $this->m_kategori->list(),
                    'barang'=> $this->m_barang->panggildata($id_barang),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'barang/v_edit'
             );
             $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            }
            else
            {
                //hapus foto
                $barang= $this->m_barang->panggildata($id_barang);
                if ($barang->gambar != "") {
                unlink('./assets/gambar/'.$barang->gambar);
                }
        //
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                

                $data = array(
                    'id_barang' => $id_barang,
                    'nama_barang' => $this->input->post('nama_barang'), 
                    'id_kategori' => $this->input->post('id_kategori'),
                    'harga' => $this->input->post('harga'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'berat' => $this->input->post('berat'),
                    'gambar' => $upload_data['uploads']['file_name'],
                    'stok' => $this->input->post('stok'),
                    
                );
                $this->m_barang->edit($data);
                $this->session->set_flashdata('pesan', 'Berhasil Diubah');
                redirect('barang');

            }

            $data = array(
                'id_barang' => $id_barang,
                'nama_barang' => $this->input->post('nama_barang'), 
                'id_kategori' => $this->input->post('id_kategori'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi'),
                'berat' => $this->input->post('berat'),
                'stok' => $this->input->post('stok'),
                //'gambar' => $upload_data['uploads']['file_name'],
                
            );
            $this->m_barang->edit($data);
            $this->session->set_flashdata('pesan', 'Berhasil Diubah');
            redirect('barang');
            
        } 
        
        $data = array(
            'title' => 'Ubah Data',
            'kategori' => $this->m_kategori->list(),
            'barang'=> $this->m_barang->panggildata($id_barang),
            'isi' => 'barang/v_edit'
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Delete one item
    public function hapus( $id_barang )
    {
        //hapus foto
        $barang= $this->m_barang->panggildata($id_barang);
        if ($barang->gambar != "") {
            unlink('./assets/gambar/'.$barang->gambar);
        }
        //
        $data = array('id_barang' => $id_barang );
        $this->m_barang->hapus($data);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('barang');
    }


    public function excel()
    {
        $idtoko = $this->session->userdata('id_user');

        $data_barang = $this->m_barang->listexcel($idtoko)->result();
        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'N0')
        ->setCellValue('B1', 'NAMA BARANG')
        ->setCellValue('C1', 'KATEGORI')
        ->setCellValue('D1', 'HARGA')
        ->setCellValue('E1', 'DESKRIPSI')
        ->setCellValue('F1', 'GAMBAR')
        ->setCellValue('G1', 'BERAT')
        ->setCellValue('H1', 'STOK');

        $baris=2;
        $no=1;

        foreach ($data_barang as $brg) {
            $spreadsheet->getActiveSheet()->setCellValue('A'.$baris, $no++)
                        ->setCellValue('B'.$baris, $brg->nama_barang)
                        ->setCellValue('C'.$baris, $brg->nama_kategori)
                        ->setCellValue('D'.$baris, $brg->harga)
                        ->setCellValue('E'.$baris, $brg->deskripsi)
                        ->setCellValue('F'.$baris, $brg->gambar)
                        ->setCellValue('G'.$baris, $brg->berat)
                        ->setCellValue('H'.$baris, $brg->stok);

            $baris++;
        }
        $writer= new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Barang.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');


    }
    public function excelbukang()
    {
        $idtoko = $this->session->userdata('id_user');
        
        $data['barang'] = $this->m_barang->listexcel($idtoko)->result();

        //print_r($data);
        //die();

        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();
        
        $object->getProperties()->setCreator("BukaLapas");
        $object->getProperties()->setLastModifiedBy("BukaLapas");
        $object->getProperties()->setTitle("Daftar Barang");

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->setCellValue('A1', 'N0');
        $object->getActiveSheet()->setCellValue('B1', 'NAMA BARANG');
        $object->getActiveSheet()->setCellValue('C1', 'KATEGORI');
        $object->getActiveSheet()->setCellValue('D1', 'HARGA');
        $object->getActiveSheet()->setCellValue('E1', 'DESKRIPSI');
        $object->getActiveSheet()->setCellValue('F1', 'GAMBAR');
        $object->getActiveSheet()->setCellValue('G1', 'BERAT');
        $object->getActiveSheet()->setCellValue('H1', 'STOK');

        $baris = 2;
        $no=1;

        foreach ($data['barang'] as $brg) {
            $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
            $object->getActiveSheet()->setCellValue('B'.$baris, $brg->nama_barang);
            $object->getActiveSheet()->setCellValue('C'.$baris, $brg->nama_kategori);
            $object->getActiveSheet()->setCellValue('D'.$baris, $brg->harga);
            $object->getActiveSheet()->setCellValue('E'.$baris, $brg->deskripsi);
            $object->getActiveSheet()->setCellValue('F'.$baris, $brg->gambar);
            $object->getActiveSheet()->setCellValue('G'.$baris, $brg->berat);
            $object->getActiveSheet()->setCellValue('H'.$baris, $brg->stok);

            $baris++;
        }

        $filename= "Data_Barang".'.xlsx';
        $object->getActiveSheet()->setTitle("Data Barang");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;

    }

    public function pdf()
    {
        $idtoko = $this->session->userdata('id_user');
        $data['barang'] = $this->m_barang->listpdf($idtoko)->result();

        require('./vendor/autoload.php');
        $mpdf = new \Mpdf\Mpdf(['orientation'=> 'P']);
        $laporan = $this->load->view('v_pdfbarang', $data, true);
        $mpdf->WriteHTML($laporan);
        $mpdf->Output();
    }

    public function pdfdom()
	{
        $idtoko = $this->session->userdata('id_user');

        $this->load->library('pdf');
        $data['barang'] = $this->m_barang->listpdf($idtoko)->result();

        $this->load->view('v_pdfbarang', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->pdf->set_paper($paper_size, $orientation);
        
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $this->pdf->load_html($html);
        $this->pdf->render();
        $this->pdf->stream("data_barang.pdf", array('Attachment' =>0));
    }





}

/* End of file Barang.php */

