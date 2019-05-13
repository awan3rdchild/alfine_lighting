<?php
class M_pengguna extends CI_Model{
	function get_pengguna(){
		$hsl=$this->db->query("SELECT * FROM tbl_user");
		return $hsl;
	}
	function simpan_pengguna($nama,$username,$password,$no_hp,$level){
		$hsl=$this->db->query("INSERT INTO tbl_user(user_nama,user_username,user_password,no_hp,user_level,user_status) VALUES ('$nama','$username',md5('$password'),'$no_hp','$level','1')");
		return $hsl;
	}
	function update_pengguna_nopass($kode,$nama,$username,$no_hp,$level){
		$hsl=$this->db->query("UPDATE tbl_user SET user_nama='$nama',user_username='$username',no_hp='$no_hp', user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_pengguna($kode,$nama,$username,$password,$no_hp,$level){
		$hsl=$this->db->query("UPDATE tbl_user SET user_nama='$nama',user_username='$username',user_password=md5('$password'),no_hp='$no_hp', user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_status_non($kode){
		$hsl=$this->db->query("UPDATE tbl_user SET user_status='0' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_status_aktif($kode){
		$hsl=$this->db->query("UPDATE tbl_user SET user_status='1' WHERE user_id='$kode'");
		return $hsl;
	}
}