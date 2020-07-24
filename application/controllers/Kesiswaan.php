<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kesiswaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


public function index()
{    
        $data['title'] = 'Arsip Kesiswaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email=$this->session->userdata('email');
        $this->load->model('Kesiswaan_model','query');
        $data['arsip']=$this->query->getArsipSiswa();
        // $data['isemptydb']=count($this->query->infopersonal($email));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kesiswaan/arsipsiswa', $data, $data);
        $this->load->view('templates/footer');
}

public function addarsip()
    {
        $data['title'] = 'Tambah Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kesiswaan_model','query');
        $data['arsip']=$this->query->getArsipSiswa();
        $isemptydb=count($this->query->getArsipSiswa());

        $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');
        $this->form_validation->set_rules('nama_siswa', 'Nama siswa ?', 'required|trim');
        $this->form_validation->set_rules('doc_date', 'Tanggal dokumen ?', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kesiswaan/arsipsiswa', $data, $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Nama siswa,nama dokumen,tanggal dokumen tidak boleh kosong !
              </div>');            
              redirect('kesiswaan'); 
        } else {
            $nis = $this->input->post('nis');
            $nama_siswa = $this->input->post('nama_siswa');            
            $doc_name = $this->input->post('doc_name');
            $doc_number = $this->input->post('doc_number');            
            $doc_date = $this->input->post('doc_date');
            $deskripsi = $this->input->post('deskripsi');
            // Check file
            $upload_file = $_FILES['doc_file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                $config['max_size']     = '10048';
                $config['upload_path'] = './assets/doc/kesiswaan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('doc_file')) {
                    if($isemptydb>0){
                    $old_file = $data['arsip']['doc_file'];
                    if ($old_file != 'default.png') {
                            unlink(FCPATH . 'assets/doc/kesiswaan/' . $old_file['doc_file']);
                    
                    }
                    }
                    

                    $new_file = $this->upload->data('file_name');
                    $this->db->set('doc_file', $new_file);
                   
                   
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if(!$new_file==""){
                $dataArsip = [
                    'nis' =>$nis,
                    'nama_siswa'=>$nama_siswa,
                    'doc_name' => $doc_name,
                    'doc_number' => $doc_number,                    
                    'doc_file' => $new_file,                                        
                    'doc_date' => $doc_date,                    
                    'deskripsi' => $deskripsi

                ];
                $this->db->insert('arsip_siswa',$dataArsip);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Your document has been added !
                        </div>');
                        redirect('kesiswaan');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your filed to uploade ! Size no more then 1 Mb !
                </div>');
                redirect('kesiswaan'); 
            }
            
        }
    }

    public function edit_arsip()
    {
        $data['title'] = 'Edit Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kesiswaan_model','query');
        $data['arsip']=$this->query->getArsipSiswa();
        $old_file=$this->query->getDocFile($this->input->post('id_arsip'));
        // var_dump($old_file['doc_file']); die;

        $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');
        $this->form_validation->set_rules('nama_siswa', 'Nama siswa ?', 'required|trim');
        $this->form_validation->set_rules('doc_date', 'Tanggal dokumen ?', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/arsip', $data, $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Nama siswa,nama dokumen,tanggal dokumen tidak boleh kosong !
          </div>');  
            redirect('kesiswaan');
        } else {
            $newdocname = $this->input->post('doc_name');
            // Check file
            $upload_file = $_FILES['doc_file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                $config['max_size']     = '10048';
                $config['upload_path'] = './assets/doc/kesiswaan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('doc_file')) {
                   
                    if ($old_file['doc_file']!='default.png') {
                            unlink(FCPATH . 'assets/doc/kesiswaan/' . $old_file['doc_file']);
                    }

                    $new_file = $this->upload->data('file_name');
                    $this->db->set('doc_file', $new_file);
                   
                   
                } else {
                    echo $this->upload->display_errors();
                }
            }

             // Update arsip
            $this->db->set('nis', $this->input->post('nis'));
            $this->db->set('nama_siswa', $this->input->post('nama_siswa'));
            $this->db->set('doc_name', $this->input->post('doc_name'));
            $this->db->set('doc_number', $this->input->post('doc_number'));            
            $this->db->set('doc_date', $this->input->post('doc_date'));
            $this->db->set('deskripsi', $this->input->post('deskripsi'));
            
             $this->db->where('id_arsip', $this->input->post('id_arsip'));
             $this->db->update('arsip_siswa');
 
             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Your arsip has been updated !
           </div>');
             redirect('kesiswaan');
         
            
        }
    }

public function delete_arsip_siswa($id_arsip){
        $this->load->model('Kesiswaan_model','query');
        $docfile=$this->query->getDocFile($id_arsip);
        // var_dump(file_exists('./assets/doc/kesiswaan/' . $docfile['doc_file'])); die;
		if($id_arsip==""){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
           Arsip gagal dihapus  !
          </div>');
			redirect('kesiswaan');
		}else{		
            if (file_exists('./assets/doc/kesiswaan/' . $docfile['doc_file'])){                
                unlink('assets/doc/kesiswaan/' . $docfile['doc_file']); 
                $this->db->where('id_arsip', $id_arsip);
                $this->db->delete('arsip_siswa');  
                
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Arsip telah dihapus !
              </div>');
                redirect('kesiswaan');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Arsip gagal dihapus !
              </div>');
              redirect('kesiswaan');
            }

		}
}



   
    
}
