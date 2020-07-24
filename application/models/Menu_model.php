<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.`id`,`user_sub_menu`.`menu_id`,`user_sub_menu`.`title`,`user_sub_menu`.`url`,`user_sub_menu`.`icon`,`user_sub_menu`.`is_active`, `user_menu`.`menu`
        FROM    `user_sub_menu` JOIN `user_menu`
        ON      `user_sub_menu`.`menu_id`=`user_menu`.`id`";

        return $this->db->query($query)->result_array();
    }
}
