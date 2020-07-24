<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // echo 'Selama datang '.$data['user']['name'].'!';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data, $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        // echo 'Selama datang '.$data['user']['name'].'!';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data, $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        // echo 'Selama datang '.$data['user']['name'].'!';

        $this->db->where('id !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data, $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access changed !
          </div>');
    }

    public function pegawai()
    {
        $data['title'] = 'Data Kepegawaian';
        $email=$this->session->userdata('email');
        $roleID=$this->session->userdata('role_id');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','umodle');
        $data['umodle']=$this->table-> member();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/kepegawaian', $data, $data);
        $this->load->view('templates/footer');
    }

    // public function ekobima()
    // {
    //     $data['title'] = 'Daftar Kegiatan Ekobang Bina Masyarakat';
    //     $email=$this->session->userdata('email');
    //     $roleID=$this->session->userdata('role_id');
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model('User_model','table');
    //     $data['table']=$this->table->tabelEkobima($email,$roleID);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('tabel/ekobima', $data, $data);
    //     $this->load->view('templates/footer');
    // }

    // public function ekocika()
    // {
    //     $data['title'] = 'Daftar Kegiatan Ekobang Cipta Karya';
    //     $email=$this->session->userdata('email');
    //     $roleID=$this->session->userdata('role_id');
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model('User_model','table');
    //     $data['table']=$this->table->tabelEkocika($email,$roleID);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('tabel/ekocika', $data, $data);
    //     $this->load->view('templates/footer');
    // }
    // public function ekosda()
    // {
    //     $data['title'] = 'Daftar Kegiatan Ekobang Sumber Daya Air';
    //     $email=$this->session->userdata('email');
    //     $roleID=$this->session->userdata('role_id');
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model('User_model','table');
    //     $data['table']=$this->table->tabelEkosda($email,$roleID);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('tabel/ekosda', $data, $data);
    //     $this->load->view('templates/footer');
    // }
    // public function ekosekre()
    // {
    //     $data['title'] = 'Daftar Kegiatan Ekobang Pengadaan Barang & Jasa';
    //     $email=$this->session->userdata('email');
    //     $roleID=$this->session->userdata('role_id');
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model('User_model','table');
    //     $data['table']=$this->table->tabelEkosekre($email,$roleID);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('tabel/ekosekre', $data, $data);
    //     $this->load->view('templates/footer');
    // }
}
