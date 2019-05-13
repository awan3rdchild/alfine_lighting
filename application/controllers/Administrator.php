<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('mlogin');
    }
    function index(){
        $x['judul']="Silahkan Masuk..!";
        $this->load->view('admin/v_login',$x);
    }
    function cekuser(){
        $username=strip_tags(stripslashes($this->input->post('username',TRUE)));
        $password=strip_tags(stripslashes($this->input->post('password',TRUE)));
        $u=$username;
        $p=$password;
        $cadmin=$this->mlogin->cekadmin($u,$p);
         if($cadmin->num_rows > 0){
         $this->session->set_userdata('masuk',true);
         $this->session->set_userdata('user',$u);
         $xcadmin=$cadmin->row_array();
         if($xcadmin['user_level']=='1')
            $this->session->set_userdata('akses','1');
            $idadmin=$xcadmin['user_id'];
            $user_nama=$xcadmin['user_nama'];
            $nohp=$xcadmin['no_hp'];
            $this->session->set_userdata('idadmin',$idadmin);
            $this->session->set_userdata('nama',$user_nama);

         if($xcadmin['user_level']=='2'){
             $this->session->set_userdata('akses','2');
             $idadmin=$xcadmin['user_id'];
             $user_nama=$xcadmin['user_nama'];
             $this->session->set_userdata('idadmin',$idadmin);
             $this->session->set_userdata('nama',$user_nama);
         } //Front Office
    }

       if($this->session->userdata('akses')=='1'){

        $time = date("d-m-Y h:i:s");
	    require "algoritma/hash.php";
	    $hash = new \phpseclib\Crypt\Hash('sha512');
	    $new_string = bin2hex($hash->hash($u.$p.$time));
        $code= hexdec(substr($new_string,0,6));
        
        $newcode= strtoupper($code);
	    $verif1 =substr($newcode,0,6);
	    if (strlen($verif1)==6) {
		    $verif = $verif1;
	    }else{
	    	$verif = $verif1."1";
        }

        //generete kode otp
        $userkey = "bt9qfn";
        $passkey = "alfinelighting";
        $telepon=$nohp;
        $message = "--- Alfine Lighting --- $verif1";
        $url = "https://reguler.zenziva.net/apps/smsapi.php";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);

        //input otp ke database
        $cadmin=$this->mlogin->acakotp($verif,$user_nama);

        redirect('administrator/berhasilloginadmin');

            } else if($this->session->userdata('akses')=='2'){
                redirect('administrator/berhasilloginkaryawan');
            } else {
                redirect('administrator/gagallogin');
            }
    }

        function berhasilloginadmin(){
            redirect('welcome');
        }
        function berhasilloginkaryawan(){
            redirect('home');
        }
        function gagallogin(){
            $url=base_url('administrator');
            echo $this->session->set_flashdata('msg','Username Atau Password Salah');
            redirect($url);
        }
        function logout(){
            $this->session->sess_destroy();
            $url=base_url('administrator');
            redirect($url);
        }
    }