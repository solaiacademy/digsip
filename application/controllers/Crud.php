<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Add New Activity Object';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('kegiatan')->result_array();

        $this->form_validation->set_rules('objectname', 'Kegiatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('crud/index', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('User_model','um');
            $data = [
                'objek_kegiatan' => $this->input->post('objectname'),
                'id_table'=> $this->um->getIdTable()
            ];

            $this->db->insert('kegiatan',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success new object added
          </div>');
            redirect('crud/showobject');
        }
    }
   

    public function showObject(){
        $data['title'] = 'Daftar Kegiatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','table');
        $data['kegiatan']=$this->table-> getTableKegiatan($this->table-> getIdTable());
        // var_dump( $data['kegiatan']); die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tabel/kegiatan', $data, $data);
        $this->load->view('templates/footer');
    }

    public function edit(){
        $this->form_validation->set_rules('id_kegiatan', 'id_kegiatan', 'required');
		$this->form_validation->set_rules('objek_kegiatan', 'objek_kegiatan', 'required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data gagal diedit !");
			redirect('crud/showobject');
		}else{
			$data=array(
				"objek_kegiatan"=>$_POST['objek_kegiatan'],
			);
			$this->db->where('id_kegiatan', $_POST['id_kegiatan']);
			$this->db->update('kegiatan',$data);
			$this->session->set_flashdata('message',"Data berhasil diedit");
			redirect('crud/showobject');
		}
    }
 

	public function delete($id)
	{
		if($id==""){
			$this->session->set_flashdata('message',"Data anda gagal dihapus !");
			redirect('crud');
		}else{
			$this->db->where('id_kegiatan', $id);
			$this->db->delete('kegiatan');
			$this->session->set_flashdata('message',"Data berhasil dihapus");
			redirect('crud/showobject');
		}
	}
    
}
