<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{

    public function setLog($iduser, $activity){
        $data = [
            'id_user' => $iduser,
            'date' => time(),
            'activity' => $activity
        ];
        $this->db->insert('log', $data);
    }
    
}
