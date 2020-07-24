<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum_model extends CI_Model
{

    public function getArsipNilai(){
        $query="SELECT * FROM arsip_nilai";
        
        return $this->db->query($query)-> result_array();
    }

    public function getDocFile($idarsip){
        $query="SELECT doc_file
        FROM arsip_nilai
        WHERE id_arsip='$idarsip'";
        
        return $this->db->query($query)-> row_array();
    }

    public function getArsipNilaiById($idarsip){
        $query="SELECT * FROM arsip_nilai WHERE id_arsip=$idarsip";
        
        return $this->db->query($query)-> row_array();
    }


}
