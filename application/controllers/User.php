<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data, $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            // Check image
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // Update name
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated !
          </div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Curent Password', 'required|trim');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[3]|matches[repeat_password]');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|min_length[3]|matches[new_password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            if (!password_verify($current_password, $data['user']['password'])) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong current password !
              </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Please input diferent password !
                  </div>');
                    redirect('user/changepassword');
                } else {
                    $password_has = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_has);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password changed !
                  </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function infopribadi()
    {
        $data['title'] = 'Detail Data Pribadi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email=$this->session->userdata('email');
        $this->load->model('User_model','query');
        $data['infoperson']=$this->query->infopersonal($email);
        $data['member']=$this->query->member($this->session->userdata('id'));
        $data['isemptydb']=count($this->query->infopersonal($email));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/personal', $data, $data);
        $this->load->view('templates/footer');
    }

    public function formedit()
    {
        $data['title'] = 'Edit Data Pribadi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','query');
        $data['row']=$this->query->memberbyid($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/editpersonal', $data, $data);
        $this->load->view('templates/footer');
    }

    public function formeditpegawai($nik)
    {
        $data['title'] = 'Edit Data Pribadi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','query');
        $data['row']=$this->query->memberbyNIK($nik);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/editpersonal', $data, $data);
        $this->load->view('templates/footer');
    }
    
 
public function kepegawaian(){
    $data['title'] = 'Data Kepegawaian';
    $email=$this->session->userdata('email');
    $roleID=$this->session->userdata('role_id');
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model','table');
    $data['member']=$this->table-> member();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pegawai/kepegawaian', $data, $data);
    $this->load->view('templates/footer');
}

public function kepegawaianExportExcel(){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model','table');
    $data['member']=$this->table-> member();

    
    $this->load->view('report/pegawaiexcel', $data, $data);
}

// public function kepegawaianExportExcelv2(){
//     // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
//     $this->load->model('User_model','table');
//     $data['member']=$this->table-> memberv2();

//     require(APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php');
//     require(APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php/Writer/Excel2007.php');

//     $object=new PHPExcel();
//     $object->getProperties()->setCreator($data['user']['name']);
//     $object->getProperties()->setLastModifiedBy($data['user']['name']);
//     $object->getProperties()->setTitle('Data Pegawai SMK N 1 Linggang Bigung');
//     $object->setActiveSheetIndex(0);
//     $object->setActiveSheet->setCellValue ('A1','No');
//     $object->setActiveSheet->setCellValue ('B1','NIK');
//     $object->setActiveSheet->setCellValue ('C1','Nama');
//     $object->setActiveSheet->setCellValue ('D1','Tempat Lahir');
//     $object->setActiveSheet->setCellValue ('D1','Tanggal Lahir');
//     $object->setActiveSheet->setCellValue ('E1','Jenis Kelamin');
//     $object->setActiveSheet->setCellValue ('F1','Tingkat Pendidikan');
//     $object->setActiveSheet->setCellValue ('G1','Status Pegawai');
//     $object->setActiveSheet->setCellValue ('H1','TMT');
//     $object->setActiveSheet->setCellValue ('I1','Jabatan');
//     $object->setActiveSheet->setCellValue ('J1','Telpon');
//     $object->setActiveSheet->setCellValue ('K1','Email');

//     $bari=2;
//     $no=1;

//     foreach($data['member'] as $m){
//         $object->getActiveSheet->setCellValue('A',$baris, $no++);
//         $object->getActiveSheet->setCellValue('B',$baris, $m->nik);        
//         $object->getActiveSheet->setCellValue('C',$baris, $m->name);
//         $object->getActiveSheet->setCellValue('D',$baris, $m->tempat_lahir);
//         $object->getActiveSheet->setCellValue('E',$baris, $m->tgl_lahir);
//         $object->getActiveSheet->setCellValue('F',$baris, $m->jenis_kelamin);
//         $object->getActiveSheet->setCellValue('G',$baris, $m->tingkat_pendidikan);
//         $object->getActiveSheet->setCellValue('H',$baris, $m->status_pegawai);
//         $object->getActiveSheet->setCellValue('I',$baris, $m->tmt_awal);
//         $object->getActiveSheet->setCellValue('J',$baris, $m->jabatan);
//         $object->getActiveSheet->setCellValue('K',$baris, $m->no_hp);
//         $object->getActiveSheet->setCellValue('L',$baris, $m->email);
//     }

//     $fileName="GTK-SMK1LIBI-".date('d-m-Y')."-".time().".xls";
//     $object->getActiveSheet->setTitle('Data Pegawai');
//     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//     header('Content-Disposition: attachment; filename="'.$fileName.'"');
//     header("Chace-Control: mx-age=0");
//     $writer=PHPExcel_IOFactory::createWriter($object,'Excel2007');
//     $writer->save('php://output');
//     exit;
    
    
//     // $this->load->view('report/pegawaiexcel', $data, $data);
// }

public function kepegawaianExportPdf(){
    $this->load->library('dompdf_gen');
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model','table');
    $data['member']=$this->table-> member();    
    $this->load->view('report/pegawaipdf', $data, $data);
    $paper_size='A4';
    $orientation='landscape';
    $html=$this->output->get_output();
    $this->dompdf->set_paper($paper_size,$orientation);
    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $fileName="GTK-SMK1LIBI-".date('d-m-Y')."-".time().".pdf";
    $this->dompdf->stream($fileName, array('Attachment'=>0));
}

public function kepegawaianPrint(){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model','table');
    $data['member']=$this->table-> member();

    
    $this->load->view('report/pegawaiprint', $data, $data);
}

public function editdatapersonal(){
        $data['title'] = 'Edit Data Pegawai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('nik', 'No KTP ?', 'required|trim');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir ?', 'required|trim');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir ?', 'required|trim');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin ?', 'required|trim');
            $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat pendidikan ?', 'required|trim');
            $this->form_validation->set_rules('status_pegawai', 'Status pegawai ?', 'required|trim');
            $this->form_validation->set_rules('tmt_awal', 'TMT awal ?', 'required|trim');
            $this->form_validation->set_rules('jabatan', 'Jabatan ?', 'required|trim');
            $this->form_validation->set_rules('no_hp', 'No HP/WA ?', 'required|trim');
    
    
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pegawai/personal', $data, $data);
                $this->load->view('templates/footer');
                if($this->input->post('user_id')==$data['user']['id']){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed data added
              </div>');
              redirect('user/infopribadi');
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed data added
              </div>');
              redirect('user/kepegawaian');
                }
                
                
            } else {
                $data = [
                    'nik' => $this->input->post('nik'),
                    'tempat_lahir'=>$this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                    'status_pegawai' => $this->input->post('status_pegawai'),
                    'tmt_awal' => $this->input->post('tmt_awal'),
                    'jabatan' => $this->input->post('jabatan'),
                    'no_hp' => $this->input->post('no_hp')
                ];
    
                $this->db->where('user_id', $_POST['user_id']);
                $this->db->update('kepegawaian',$data); 
                if($this->input->post('user_id')==$data['user']['id']){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Update data successfull !
              </div>');
              redirect('user/infopribadi');
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Update data successfull !
              </div>');
              redirect('user/kepegawaian');
                }
                
            }
}

public function addpegawai(){
    $data['title'] = 'Menambah Pegawai Baru';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nik', 'No KTP ?', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir ?', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir ?', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin ?', 'required');
        $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat pendidikan ?', 'required');
        $this->form_validation->set_rules('status_pegawai', 'Status pegawai ?', 'required');
        $this->form_validation->set_rules('tmt_awal', 'TMT awal ?', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan ?', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP/WA ?', 'required');


        if ($this->form_validation->run() == false) {
            $email=$this->session->userdata('email');
            $this->load->model('User_model','query');
            $data['infoperson']=$this->query->infopersonal($email);
            $data['isemptydb']=count($this->query->infopersonal($email));
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/personal', $data, $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed data added
          </div>');
            
        } else {
            $data = [
                'user_id' => $this->session->userdata('id'),
                'nik' => $this->input->post('nik'),
                'tempat_lahir'=>$this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                'status_pegawai' => $this->input->post('status_pegawai'),
                'tmt_awal' => $this->input->post('tmt_awal'),
                'jabatan' => $this->input->post('jabatan'),
                'no_hp' => $this->input->post('no_hp')
            ];

            $this->db->insert('kepegawaian',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success new object added
          </div>');
            redirect('user/infopribadi');
        }
}
   

    public function arsip()
    {
        $data['title'] = 'Arsip Pribadi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email=$this->session->userdata('email');
        $this->load->model('User_model','query');
        $id=$this->session->userdata('id');
        $data['arsip']=$this->query->getArsip($id);
        $data['id']=$id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/arsip', $data, $data);
        $this->load->view('templates/footer');
    }

    public function switcharsip($user_id)
    {
        $data['title'] = 'Arsip Pribadi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email=$this->session->userdata('email');
        $this->load->model('User_model','query');
        // var_dump($user_id); die;
        $data['arsip']=$this->query->getArsip($user_id);
        $data['id']=$user_id;
       
        // $data['isemptydb']=count($this->query->infopersonal($email));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/arsip', $data, $data);
        $this->load->view('templates/footer');
    }

    public function addarsip()
    {
        $data['title'] = 'Tambah Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','query');
        $data['arsip']=$this->query->getArsip($this->session->userdata('id'));
        $isemptydb=count($this->query->getArsip($this->session->userdata('id')));

        $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/arsip', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $docname = $this->input->post('doc_name');
            // Check image
            $upload_file = $_FILES['doc_file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                $config['max_size']     = '10048';
                $config['upload_path'] = './assets/doc/arsip/';

                $this->load->library('upload', $config);
               
                    if ($this->upload->do_upload('doc_file')) {
                        if($isemptydb>0){
                        $old_file = $data['arsip']['doc_file'];
                        if ($old_file != 'default.png') {
                                unlink(FCPATH . 'assets/doc/arsip/' . $old_file['doc_file']);
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
                    'id_user' => $this->session->userdata('id'),
                    'doc_name' =>$docname,
                    'doc_file'=>$new_file
                ];
                        $this->db->insert('arsip_kepegawaian',$dataArsip);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Your document has been upload !
                        </div>');
                        redirect('user/arsip');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your filed to uploade ! Size no more then 1 Mb !
                </div>');
                redirect('user/arsip'); 
            }
            
        }
    }

    public function edit_arsip()
    {
        $data['title'] = 'Edit Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','query');
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
                $config['upload_path'] = './assets/doc/arsip/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('doc_file')) {
                   
                    if ($old_file['doc_file']!='default.png') {
                            unlink(FCPATH . 'assets/doc/arsip/' . $old_file['doc_file']);
                    }
                    $new_file = $this->upload->data('file_name');
                    $this->db->set('doc_file', $new_file); 
                } else {
                    echo $this->upload->display_errors();
                }
            }

             // Update arsip
             $this->db->set('doc_name', $newdocname);
             $this->db->where('id_arsip', $this->input->post('id_arsip'));
             $this->db->update('arsip_kepegawaian');
 
             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Your arsip has been updated !
           </div>');
             redirect('user/arsip');
         
            
        }
    }

public function deletearsip($id){
        $this->load->model('User_model','query');
        $docfile=$this->query->getDocFile($id);
		if($id==""){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
           Arsip gagal dihapus  !
          </div>');
			redirect('user/arsip');
		}else{		
            if (file_exists('./assets/doc/arsip/' . $docfile['doc_file'])){                
                unlink('assets/doc/arsip/' . $docfile['doc_file']); 
                $this->db->where('id_arsip', $id);
                $this->db->delete('arsip_kepegawaian');  
                
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Arsip telah dihapus !
              </div>');
                redirect('user/arsip');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Arsip gagal dihapus !
              </div>');
              redirect('user/arsip');
            }
		}
}

public function arsiptu(){
    $data['title'] = 'Arsip Tata Usaha';
    $email=$this->session->userdata('email');
    $roleID=$this->session->userdata('role_id');
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model','query');
    $data['arsipTU']=$this->query-> tataUsaha();    
    $data['jenisSurat']=$this->query-> jenisSurat();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pegawai/arsiptatausaha', $data, $data);
    $this->load->view('templates/footer');
}    

public function addarsiptu(){
        $data['title'] = 'Tambah Arsip';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model','query');
        $data['arsipTU']=$this->query-> tataUsaha();
        $isemptydb=count($this->query-> tataUsaha());

        $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');
        $this->form_validation->set_rules('doc_clasification', 'Klasifikasi dokumen ?', 'required|trim');
        $this->form_validation->set_rules('doc_category', 'Kategori dokumen ?', 'required|trim');
        $this->form_validation->set_rules('doc_date', 'Tanggal dokumen ?', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/arsiptatausaha', $data, $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed data added ! 
                </div>');
                redirect('user/arsiptu');
        } else {
            // Check file
            $upload_file = $_FILES['doc_file']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                $config['max_size']     = '10048';
                $config['upload_path'] = './assets/doc/tatausaha/';

                $this->load->library('upload', $config);
                
                    if ($this->upload->do_upload('doc_file')) {
                        if( $isemptydb >0){
                        $old_file = $data['arsipTU']['doc_file'];
                        if ($old_file != 'default.png') {
                                unlink(FCPATH . 'assets/doc/tatausaha/' . $old_file['doc_file']);
                        
                        }
                    }
                    $new_file = $this->upload->data('file_name');
                    $this->db->set('doc_file', $new_file);
                }  else {
                    echo $this->upload->display_errors();
                }
            }
            //  var_dump($new_file); die;
            if(!$new_file==""){
                $dataArsip = [
                    'doc_name' => $this->input->post('doc_name'),
                    'doc_clasification' =>$this->input->post('doc_clasification'),
                    'doc_category' => $this->input->post('doc_category'),
                    'doc_file'=>$new_file,
                    'doc_date' => $this->input->post('doc_date'),
                    'doc_number' => $this->input->post('doc_number'),
                    'deskripsi' => $this->input->post('deskripsi')
                    
                ];
                $this->db->insert('arsip_tatausaha',$dataArsip);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your document has been added !
                </div>');
                redirect('user/arsiptu');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your filed to uploade ! No file or size no more then 1 Mb !
                </div>');
                redirect('user/arsiptu'); 
            }
            
        }
    }

        public function edit_arsiptu(){
            $data['title'] = 'Edit Arsip';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('User_model','query');
            $data['arsipTU']=$this->query-> tataUsaha();
            $isemptydb=count($this->query-> tataUsaha());
    
            $this->form_validation->set_rules('doc_name', 'Nama dokumen ?', 'required|trim');
            $this->form_validation->set_rules('doc_number', 'Nomor dokumen ?', 'required|trim');
            $this->form_validation->set_rules('doc_clasification', 'Klasifikasi dokumen ?', 'required|trim');
            $this->form_validation->set_rules('doc_category', 'Kategori dokumen ?', 'required|trim');
            $this->form_validation->set_rules('doc_date', 'Tanggal dokumen ?', 'required|trim');
    
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pegawai/arsiptatausaha', $data, $data);
                $this->load->view('templates/footer');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Failed data edit ! 
                    </div>');
                    redirect('user/arsiptu');
            } else {
                // Check file
                $upload_file = $_FILES['doc_file']['name'];
    
                if ($upload_file) {
                    $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|csv|docx|doc';
                    $config['max_size']     = '10048';
                    $config['upload_path'] = './assets/doc/tatausaha/';
    
                    $this->load->library('upload', $config);
                    
                        if ($this->upload->do_upload('doc_file')) {
                            if( $isemptydb >0){
                            $old_file = $data['arsipTU']['doc_file'];
                            if ($old_file != 'default.png') {
                                    unlink(FCPATH . 'assets/doc/tatausaha/' . $old_file['doc_file']);
                            
                            }
                        }
                        $new_file = $this->upload->data('file_name');                       
                        $this->db->set('doc_file', $new_file);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
                
                    $data = [
                        'doc_name' => $this->input->post('doc_name'),
                        'doc_clasification' =>$this->input->post('doc_clasification'),
                        'doc_category' => $this->input->post('doc_category'),
                        'doc_date' => $this->input->post('doc_date'),
                        'doc_number' => $this->input->post('doc_number'),
                        'deskripsi' => $this->input->post('deskripsi')
                        
                    ];
                    $this->db->where('id_arsip', $_POST['id_arsip']);
                    $this->db->update('arsip_tatausaha',$data); 
    
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Your document has been updated !
                    </div>');
                    redirect('user/arsiptu');
                                
            }
        }
    
        public function delete_arsiptu($id){
            $this->load->model('User_model','query');
            $docfile=$this->query->getDocFileTU($id);
            if($id==""){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
               Arsip gagal dihapus  !
              </div>');
                redirect('user/arsip');
            }else{		
                if (file_exists('./assets/doc/tatausaha/' . $docfile['doc_file'])){                
                    unlink('assets/doc/tatausaha/' . $docfile['doc_file']); 
                    $this->db->where('id_arsip', $id);
                    $this->db->delete('arsip_tatausaha');  
                    
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Arsip telah dihapus !
                  </div>');
                    redirect('user/arsiptu');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Arsip gagal dihapus !
                  </div>');
                  redirect('user/arsiptu');
                }
            }
    }


        public function nomorsurat(){
            $data['title'] = 'Daftar Nomor Surat';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('User_model','query');
            $data['nomorsurat']=$this->query-> allDocNumber();
        
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/nomorsurat', $data, $data);
            $this->load->view('templates/footer');
        }  

        public function editnomorsurat(){
            $data['title'] = 'Daftar Nomor Surat';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('User_model','query');
            $data['nomorsurat']=$this->query-> allDocNumber();

            $this->form_validation->set_rules('deskripsi', 'deskripsi keperluan ?', 'required|trim');

            if ($this->form_validation->run() == false) {
        
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/nomorsurat', $data, $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Need document description ! 
            </div>');
            redirect('user/nomorsurat');
            }else{
             $this->db->set('deskripsi', $this->input->post('deskripsi'));
             $this->db->where('doc_number', $this->input->post('doc_number'));
             $this->db->update('nomor_surat');
             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success update  ! 
            </div>');
            redirect('user/nomorsurat');

            }
        } 

        public function deletenomorsurat($id){
            if($id==""){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
              Nomor surat '.$id.' gagal dihapus  !
              </div>');
                redirect('user/nomorsurat');
            }else{
                    $this->db->where('doc_number', $id);
                    $this->db->delete('nomor_surat');  
                    
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Nomor surat '.$id.' telah dihapus !
                  </div>');
                    redirect('user/nomorsurat');               
            }
    }

        public function rolenomorsurat(){
            $data['title'] = '';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/rolenomorsurat', $data, $data);
            $this->load->view('templates/footer');
        } 

        public function generatenomorsurat()    {
        $data['title'] = '';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('deskripsi', '"uraian keperluan nomor surat"', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pegawai/rolenomorsurat', $data, $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('User_model','query');
            $NoSurat=$this->query-> generateDocNumber();
            $newNosurat=$NoSurat['doc_number']+1;
            $data = [
                'doc_number' =>  $newNosurat,
                'user_id' =>$this->session->userdata('id'),
                'deskripsi' => $this->input->post('deskripsi'),
                'date_created'=> time(),
                
            ];
            $this->db->insert('nomor_surat',$data);
            redirect('user/shownosurat');

                        
        }
    }

    public function shownosurat(){
        $data['title'] = '';
        $this->load->model('User_model','query');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nomorsuratanda']=$this->query-> generateDocNumberDate();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/shownomor', $data, $data);
        $this->load->view('templates/footer');
    }

}

    

