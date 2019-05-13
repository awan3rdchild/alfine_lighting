<?php
class smsgateway{
$angka1 = 000001;
	$angka2 = 999999;
 
	$hasil = rand($angka1, $angka2);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://sgw.oofnivek.com/message/queue");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=Udk6gN7XQaeQmSdyKF2vBFLcfpFphPXLswFy&token=1WGc4hpVeUNy9ooxDeAd6KppPjDGbhhzfYja&destination=+6282136708850&message=$hasil");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close ($ch); 

$output = json_decode($result, TRUE);
if($output['description'] == 'OK') {
echo 'SMS Terkirim!';
} else {
echo 'SMS Gagal Terkirim!';
}
}
?>