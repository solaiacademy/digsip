<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


public function index()
{    
        $data['title'] = 'Arsip Nilai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email=$this->session->userdata('email');
        $this->load->model('Kurikulum_model','query');
        $data['arsip']=$this->query->getArsipNilai();
        // $data['isemptydb']=count($this->query->infopersonal($email));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kurikulum/nilai', $data, $data);
        $this->load->view('templates/footer');
}

public function addarsip()
    {
        $data['title'] = 'Tambah Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kurikulum_model','query');
        $data['arsip']=$this->query->getArsipNilai();

        $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kurikulum/nilai', $data, $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Nama dokumen tidak boleh kosong !
              </div>');
        } else {
            $docname = $this->input->post('doc_name');
            $kelas = $this->input->post('kelas');
            $semester = $this->input->post('semester');
            $tahun = $this->input->post('tahun');
            $deskripsi = $this->input->post('deskripsi');
            // Check image
            $upload_file = $_FILES['doc_file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                $config['max_size']     = '10048';
                $config['upload_path'] = './assets/doc/nilai/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('doc_file')) {
                    $old_file = $data['arsip']['doc_file'];
                    if ($old_file != 'default.png') {
                            unlink(FCPATH . 'assets/doc/nilai/' . $old_file['doc_file']);
                    
                    }

                    $new_file = $this->upload->data('file_name');
                    $this->db->set('doc_file', $new_file);
                   
                   
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if(!$new_file==""){
                $dataArsip = [
                    'doc_name' =>$docname,
                    'doc_file'=>$new_file,
                    'tahun' => $tahun,
                    'semester' => $semester,                    
                    'kelas' => $kelas,                    
                    'deskripsi' => $deskripsi,

                ];
                $this->db->insert('arsip_nilai',$dataArsip);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Your document has been added !
                        </div>');
                        redirect('kurikulum');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your filed to uploade ! Size no more then 1 Mb !
                </div>');
                redirect('kurikulum'); 
            }
            
        }
    }

    public function edit_arsip()
    {
        $data['title'] = 'Edit Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pegawai_model','query');
        $data['arsip']=$this->query->getArsip($this->session->userdata('id'));
        $old_file=$this->query->getDocFile($this->input->post('id_arsip'));
        // var_dump($old_file['doc_file']); die;

        $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/arsip', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $newdocname = $this->input->post('doc_name');
            // Check file
            $upload_file = $_FILES['doc_file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                $config['max_size']     = '10048';
                $config['upload_path'] = './assets/doc/nilai/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('doc_file')) {
                   
                    if ($old_file['doc_file']!='default.png') {
                            unlink(FCPATH . 'assets/doc/nilai/' . $old_file['doc_file']);
                    }

                    $new_file = $this->upload->data('file_name');
                    $this->db->set('doc_file', $new_file);
                   
                   
                } else {
                    echo $this->upload->display_errors();
                }
            }

             // Update arsip
            //  $this->db->set('doc_name', $newdocname);
            $this->db->set('doc_name', $this->input->post('doc_name'));
            $this->db->set('tahun', $this->input->post('tahun'));
            $this->db->set('semester', $this->input->post('semester'));
            $this->db->set('kelas', $this->input->post('kelas'));
            $this->db->set('deskripsi', $this->input->post('deskripsi'));
            
             $this->db->where('id_arsip', $this->input->post('id_arsip'));
             $this->db->update('arsip_nilai');
 
             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Your arsip has been updated !
           </div>');
             redirect('kurikulum');
         
            
        }
    }

public function deletearsipnilai($id){
        $this->load->model('Kurikulum_model','query');
        $docfile=$this->query->getDocFile($id);
		if($id==""){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
           Arsip gagal dihapus  !
          </div>');
			redirect('kurikulum');
		}else{		
            if (file_exists('./assets/doc/nilai/' . $docfile['doc_file'])){                
                unlink('assets/doc/nilai/' . $docfile['doc_file']); 
                $this->db->where('id_arsip', $id);
                $this->db->delete('arsip_nilai');  
                
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Arsip telah dihapus !
              </div>');
                redirect('kurikulum');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Arsip gagal dihapus !
              </div>');
              redirect('kurikulum');
            }

		}
}



   
    
}
