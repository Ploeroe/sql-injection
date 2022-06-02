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



if (isset($_POST['comment'])) {
    $beritasekarang = $_POST['idberita'];

    if (isset($_SESSION['userid'])) {
        if (isset($_POST['komen'])) {

            $beritaid = mysqli_real_escape_string($connect, $_POST['idberita']);
            $userid = mysqli_real_escape_string($connect, $_SESSION['userid']);
            $userfirst = mysqli_real_escape_string($connect, $_SESSION['userfirst']);
            $userlast = mysqli_real_escape_string($connect, $_SESSION['userlast']);
            $usergambar = mysqli_real_escape_string($connect, $_SESSION['usergambar']);
            $komentar = mysqli_real_escape_string($connect, $_POST['komen']);
            $tanggalKomentar = date("Y-m-d H:i:s");

            $sql = mysqli_query($connect, "INSERT INTO comment (beritaid, userid, userfirst, userlast, usergambar, komentar, tanggalkomentar) VALUES ('$beritaid','$userid', '$userfirst', '$userlast', '$usergambar', '$komentar', '$tanggalKomentar');");

            $error = "Berhasil menambahkan komen baru!";
            header("location: ../?open=detail&id=$beritasekarang");
        } else {
            $error = "Anda belum menulis apa - apa!";
        }
    } else {
        $error = "Anda butuh login terlebih dahulu!";
        header("location: ../?open=login");
    }
}
