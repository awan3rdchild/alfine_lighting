<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/*
 * OTP Class
 * Class ini digunakan untuk fitur pengiriman OTP via SMS
 */
 
class Otp_class {
	 
	// var URL Server
	var $url;
	
	// var User
	var $user;
	
	// var Token
	var $token;
	 
	/**
	* Class constructor
	*
	* @return   void
	*/
	public function __construct() {
		$this->url = "https://sgw.oofnivek.com/message/queue";
		$this->user = "Udk6gN7XQaeQmSdyKF2vBFLcfpFphPXLswFy";
		$this->token = "1WGc4hpVeUNy9ooxDeAd6KppPjDGbhhzfYja";
	}
					
	public function sendsms($destination, $code) {
		// Pesan Pengiriman Kode OTP
		$message = "Kode OTP Anda adalah: ".$code;
		
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=".$this->user."&token=".$this->token."&destination=+62".$destination."&message=".$message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close ($ch); 
        
        $output = json_decode($result, TRUE);
        if(!empty($output['description'])||isset($output['description'])) {
           if($output['description'] == 'OK')
               {
               	return TRUE;
               } else {
               	return FALSE;
               }
          }
	}
}
