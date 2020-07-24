<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //this method conntain in helpers file
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Success new menu added
          </div>');
            redirect('menu');
        }
    }
    
    

    public function editMenu()
    {
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $id = $this->input->get('id');
        $data['data_menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();




        $this->form_validation->set_rules('menu_edit', 'Menu Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/menuedit', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $menu = $this->input->post('menu_edit');
            $id = $this->input->post('id');

            $this->db->set('menu', $menu);
            $this->db->where('id', $id);
            $this->db->update('user_menu');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Success edit menu ! 
              </div>');
            redirect('menu');
        }
    }

    public function deleteMenu()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Success delete menu ! 
      </div>');
        redirect('menu');
    }

    
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu', $data);
            // set log 
            $iduser=$this->session->userdata('id');
            $activity="User add menu ".$this->input->post('title');
            $this->load->model('Log_model','logAM');
            $this->logAM->setLog($iduser, $activity); 
            //end set log
            $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">
            Success new submenu added
          </div>');
            redirect('menu/submenu');
        }
    }

    // Yet done
    public function editsubmenu()
    {
        $data['title'] = 'Edit Submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $id = $this->input->get('id');
        $data['data_menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();



        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/menuedit', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            
            $this->db->where('id', $id = $this->input->post('id'));
            $this->db->update('user_sub_menu', $data);


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Success edit menu ! 
              </div>');
            redirect('menu/submenu');
        }
    }

    public function deletesubmenu($id)    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Success delete menu ! 
      </div>');
        redirect('menu/submenu');
    }


}
