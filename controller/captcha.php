<?php
if (session_id() == '') {
  session_start();
}
function acakCaptcha()
{
  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

  //untuk menyatakan $pass sebagai array
  $pass = array();

  //masukkan -2 dalam string length
  $panjangAlpha = strlen($alphabet) - 2;
  for ($i = 0; $i < 5; $i++) {
    $n = rand(0, $panjangAlpha);
    $pass[] = $alphabet[$n];
  }

  //ubah array menjadi string
  return implode($pass);
}

// untuk mengacak captcha
$code = acakCaptcha();
$_SESSION["code"] = $code;

//lebar dan tinggi captcha
$wh = imagecreatetruecolor(300, 50);

//background color 
$bgc = imagecolorallocate($wh, 7, 148, 158);

//text color 
$fc = imagecolorallocate($wh, 255, 255, 255);
imagefill($wh, 0, 0, $bgc);

/** For Lines */
$line_color = imagecolorallocate($wh, 64, 64, 64);
for ($i = 0; $i < 6; $i++) {
  imageline($wh, 0, rand() % 50, 300, rand() % 50, $line_color);
}

/*For pixels */
$pixel_color = imagecolorallocate($wh, 0, 0, 255);
for ($i = 0; $i < 1000; $i++) {
  /** width and height of text image rand() */
  imagesetpixel($wh, rand() % 300, rand() % 50, $pixel_color);
}

$font_size = 32;
$font_path = '../assets/font/';
imagettftext($wh, $font_size, 0, 85, 40, $fc, $font_path . 'louis.ttf', $code);

//( $image , $fontsize , $string , $fontcolor )
// imagestring($wh, 100, 125, 15,  $code, $fc);

//buat gambar
header('content-type: image/jpg');
imagejpeg($wh);
imagedestroy($wh);
