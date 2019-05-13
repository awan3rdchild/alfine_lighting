
<?php
    //untuk memulai session
    session_start();
     
    //set session dulu dengan nama $_SESSION["mulai"]
    if (isset($_SESSION["mulai"])) { 
        //jika session sudah ada
        $telah_berlalu = time() - $_SESSION["mulai"];
    } else { 
        //jika session belum ada
        $_SESSION["mulai"]  = time();
        $telah_berlalu      = 0;
    } 
    
    $data   = '1';
    $temp_waktu = ($data*60) - $telah_berlalu; //dijadikan detik dan dikurangi waktu yang berlalu
    $temp_menit = (int)($temp_waktu/60);                //dijadikan menit lagi
    $temp_detik = $temp_waktu%60;                       //sisa bagi untuk detik
     
    if ($temp_menit < 60) { 
        /* Apabila $temp_menit yang kurang dari 60 meni */
        $jam    = 0; 
        $menit  = $temp_menit; 
        $detik  = $temp_detik; 
    } else { 
        /* Apabila $temp_menit lebih dari 60 menit */           
        $jam    = (int)($temp_menit/60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer 
        $menit  = $temp_menit%60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
        $detik  = $temp_detik;
    }   
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Masuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Produk Alfine Lighting">
    <meta name="author" content="Alfine Lighting">
    <!-- Bootstrap -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo base_url().'assets/css/stylesl.css'?>" rel="stylesheet">
    
     <!-- Kita membutuhkan jquery, disini saya menggunakan langsung dari jquery.com, jquery ini bisa didownload dan ditaruh dilocal -->
     <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
  
  <!-- Script Timer -->
  <script type="text/javascript">
      $(document).ready(function() {
          /** Membuat Waktu Mulai Hitung Mundur Dengan 
              * var detik;
              * var menit;
              * var jam;
          */
          var detik   = <?= $detik; ?>;
          var menit   = <?= $menit; ?>;
          var jam     = <?= $jam; ?>;
                
          /**
             * Membuat function hitung() sebagai Penghitungan Waktu
          */
          function hitung() {
              /** setTimout(hitung, 1000) digunakan untuk 
                   * mengulang atau merefresh halaman selama 1000 (1 detik) 
              */
              setTimeout(hitung,1000);

              /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
              $('#timer').html(
                  '<h3>'+ menit + ' : ' + detik + '</h3>'
              );

              /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
              detik --;

              /** Jika var detik < 0
                  * var detik akan dikembalikan ke 59
                  * Menit akan Berkurang 1
              */
              if(detik < 0) {
                  detik = 59;
                  menit --;

                 /** Jika menit < 0
                      * Maka menit akan dikembali ke 59
                      * Jam akan Berkurang 1
                  */
                  if(menit < 0) {
                      menit = 59;
                      jam --;

                      /** Jika var jam < 0
                          * clearInterval() Memberhentikan Interval dan submit secara otomatis
                      */
                           
                      if(jam < 0) { 
                          clearInterval(hitung); 
                          /** Variable yang digunakan untuk submit secara otomatis di Form */
                          alert('Waktu Anda telah habis');
                          window.location.href="<?php echo base_url().'administrator/logout'?>";
                      } 
                  } 
              } 
          }           
          /** Menjalankan Function Hitung Waktu Mundur */
          hitung();
      });
  </script>
    
  </head>
  <body class="login-bg">
  

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <img width="310px" src="<?php echo base_url().'assets/img/logo.png'?>"/>
                            <div style="background:#CCC" id="timer" align="center"></div>
                      <p><?php echo $this->session->flashdata('msg');?></p>
                          <hr/>
                          <form action="<?php echo base_url().'verifikasi/verifikasiotp'?>" method="post">
                             <h5>Silahkan masukkan kode verifikasi yang telah kami kirim melalui sms.</h5>
                                <input class="form-control" width="20"type="text" name="kodeotp" placeholder="kode verifikasi" required>
                               
				                    <button type="submit" class="btn btn-lg " style="width:310px;margin-top:0px; bg-color:#ff9000;">Verifikasi</button>
                         
				                </div>     
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    
  </body>
</html>