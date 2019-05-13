<?php
class Verifikasi extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('mverifikasi');
    }
    function index(){
        $x['judul']="Silahkan Masuk..!";
        $this->load->view('admin/v_verifikasi',$x);
    }
    function verifikasiotp(){
        $kodeotp=strip_tags(stripslashes($this->input->post('kodeotp',TRUE)));
        $i=$this->session->userdata('idadmin');
        $o=$kodeotp;
        $cadmin=$this->mverifikasi->cekotp($i,$o);
           if($cadmin->num_rows == 1){
                redirect('verifikasi/berhasilverifikasi');
            }else{
                redirect('verifikasi/gagalverifikasi');
            }
            
        }

        function berhasilverifikasi(){
            redirect('home');
            session_start();
		    session_destroy();
        }
        function gagalverifikasi(){
            $url=base_url('verifikasi');
            echo $this->session->set_flashdata('msg','Kode OTP Salah');
            redirect($url);
        }
        function logout(){
            $this->session->sess_destroy();
            $url=base_url('verifikasi');
            redirect($url);
        }
    
}