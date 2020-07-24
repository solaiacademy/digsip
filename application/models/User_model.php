<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getRoleID($email){
        $query="SELECT DISTINCT(u.`role_id`)
        FROM user_access_table a, user u
        WHERE a.`id_user`=u.`id` AND u.`email`='$email'";
        
        return $this->db->query($query)-> result_array();
    }

    public function getTableCode($userID){
        $query="SELECT `table_code`
        FROM user_access_table
        WHERE id_user=$userID";
        
        return $this->db->query($query)-> row_array();
    }

    public function getIdTable(){
        $iduser=$this->session->userdata('id');
        $value = $this->getTableCode($iduser);
        $table_code = array();
        
        foreach ($value as $k => $v){
        array_push($table_code, $v);
        }
        return $table_code[0];
    }

    public function member(){
        $query="SELECT *
        FROM user u, kepegawaian k
        WHERE u.`id`=k.`user_id`";        
        return $this->db->query($query)-> result_array();
    }

    public function memberv2(){
        $query="SELECT *
        FROM user u, kepegawaian k
        WHERE u.`id`=k.`user_id`";        
        return $this->db->query($query)-> result();
    }
    
    public function infopersonal($email){
        $query="SELECT *
        FROM user u, kepegawaian k
        WHERE u.`id`=k.`user_id` AND u.`email`='$email'";        
        return $this->db->query($query)-> result_array();
    }

    public function memberbyid($id){
        $query="SELECT *
        FROM  kepegawaian 
        WHERE user_id=$id";        
        return $this->db->query($query)-> row_array();
    }

    public function memberbyNIK($nik){
        $query="SELECT *
        FROM  kepegawaian 
        WHERE nik=$nik";        
        return $this->db->query($query)-> row_array();
    }
  

    public function getArsip($iduser){
        $query="SELECT * FROM arsip_kepegawaian WHERE id_user='$iduser'";        
        return $this->db->query($query)-> result_array();
    }

    public function getDocFile($idarsip){
        $query="SELECT doc_file
        FROM arsip_kepegawaian
        WHERE id_arsip='$idarsip'";        
        return $this->db->query($query)-> row_array();
    }

    public function getArsipById($idarsip){
        $query="SELECT * FROM arsip_kepegawaian WHERE id_arsip=$idarsip";        
        return $this->db->query($query)-> row_array();
    }


    public function jenisSurat(){
        $query="SELECT * FROM jenis_surat";
        return $this->db->query($query)->result_array();
    }

    public function tataUsaha(){
        $query="SELECT t.`id_arsip` AS id_arsip,t.`doc_name` AS doc_name, t.`doc_number` AS doc_number, t.`doc_file` AS doc_file,t.`doc_clasification` AS doc_clasification, t.`doc_date` AS doc_date,t.`deskripsi` AS deskripsi, t.`doc_category` AS doc_category, j.`jenis_surat` AS jenis_surat,j.`id_surat` AS id_surat
        FROM arsip_tatausaha t, jenis_surat j
        WHERE t.`doc_category`=j.`id_surat`";
        return $this->db->query($query)-> result_array();
    }

    public function generateDocNumber(){
        $query="SELECT MAX(doc_number) as doc_number
        FROM nomor_surat";
        return $this->db->query($query)->row_array();
    }

    public function generateDocNumberDate(){
        $query="SELECT MAX(doc_number) as doc_number, date_created
        FROM nomor_surat";
        return $this->db->query($query)->row_array();
    }

    public function allDocNumber(){
        $query="SELECT * 
        FROM nomor_surat n, user u
        WHERE u.`id`=n.`user_id`";
        return $this->db->query($query)->result_array();
    }

    public function getDocFileTU($idarsip){
        $query="SELECT doc_file
        FROM arsip_tatausaha
        WHERE id_arsip='$idarsip'";        
        return $this->db->query($query)-> row_array();
    }

}
