<?php

include_once "../inc/koneksi.php";
if (session_id() == '') {
    session_start();
}

// fitur debug yang dapat kita panggil
// contoh : debug_to_console($data);
function debug_to_console($data, $context = 'Debug in Console')
{

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info(\'' . $context . ':\');';
    $output .= 'console.log(' . json_encode($data) . ');';
    $output  = sprintf('<script>%s</script>', $output);

    echo $output;
}

if (isset($_POST['like'])) {
    if (isset($_SESSION['userid'])) {


        $userid = mysqli_real_escape_string($connect, $_SESSION['userid']);
        $beritaid = mysqli_real_escape_string($connect, $_POST['idberita']);
        $komenid = mysqli_real_escape_string($connect, $_POST['idkomen']);
        $status = '1';

        $sql = mysqli_query($connect, "INSERT INTO hati (userid, beritaid, komenid, status) VALUES ('$userid','$beritaid', '$komenid','$status');");


        $error = "Liked";
    } else {

        $error = "Gagal";
    }
}

if (isset($_POST['unlike'])) {
    if (isset($_SESSION['userid'])) {

        $userid = mysqli_real_escape_string($connect, $_SESSION['userid']);
        $beritaid = mysqli_real_escape_string($connect, $_POST['idberita']);
        $komenid = mysqli_real_escape_string($connect, $_POST['idkomen']);

        $ceklike = mysqli_query($connect, "SELECT * FROM hati WHERE userid='$userid' AND beritaid='$beritaid' AND komenid='$komenid'");
        $ceklikes = mysqli_fetch_array($ceklike);

        if ($ceklikes['status'] == 1) {
            mysqli_query($connect, "UPDATE hati SET status='0' WHERE userid = '$userid' AND beritaid='$beritaid' AND komenid='$komenid';");
        } else {
            mysqli_query($connect, "UPDATE hati SET status='1' WHERE userid = '$userid' AND beritaid='$beritaid' AND komenid='$komenid';");
        }
    } else {
        $error = "Gagal";
    }
}

header("location: ../?open=detail&id=$beritaid");
