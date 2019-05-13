<?php
class Mlogin extends CI_Model{
    function cekadmin($u,$p){
        $hasil=$this->db->query("select*from tbl_user where user_username='$u'and user_password=md5('$p') and user_status='1'");
        return $hasil;
    }

    function acakotp($o,$u){
        $hasil=$this->db->query("update tbl_user SET kd_otp=md5('$o') where user_username='$u'");
    }
  
}
