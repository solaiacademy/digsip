<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kesiswaan_model extends CI_Model
{

    public function getArsipSiswa(){
        $query="SELECT * FROM arsip_siswa";
        
        return $this->db->query($query)-> result_array();
    }

    public function getDocFile($idarsip){
        $query="SELECT doc_file
        FROM arsip_siswa
        WHERE id_arsip='$idarsip'";
        
        return $this->db->query($query)-> row_array();
    }

    public function getArsipSiswaById($idarsip){
        $query="SELECT * FROM arsip_siswa WHERE id_arsip=$idarsip";
        
        return $this->db->query($query)-> row_array();
    }


}
