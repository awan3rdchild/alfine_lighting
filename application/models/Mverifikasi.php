<?php
class Mverifikasi extends CI_Model{
    function cekotp($i,$o){
        $hasil=$this->db->query("select*from tbl_user where user_id='$i' and kd_otp=md5('$o')");
        return $hasil;
    }
  
}
