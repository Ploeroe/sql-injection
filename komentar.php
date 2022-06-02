<?php
if (session_id() == '') {
    session_start();
}
?>

<?php
$id = (isset($_GET['id']) ? $_GET['id'] : '');

global $connect;

$idberita = $id;

$sql = mysqli_query($connect, "SELECT * FROM comment WHERE beritaid = '" . $id . "' ");
while ($komen = mysqli_fetch_array($sql)) {
    extract($komen);

    $idkomen = $id;

    $totallike = mysqli_query($connect, "SELECT COUNT(*) FROM hati WHERE beritaid = $idberita AND komenid = $idkomen AND `status` = 1 ");
    $totalsuka = mysqli_fetch_array($totallike);

    echo ' 
        <div class="row">
            <div class="col-1">
                <img class="imgkomen" src="' . $usergambar . '">
            </div>
            <div class="col-9 ms-3 mb-3">
                <div class="komenberita">' . $userfirst . ' ' . $userlast . '</div>
                <div class="teks-foto">' . nl2br($komentar) . '</div>
                <div class="tglberita"> Published : ' . $tanggalkomentar . ' </div>
            </div>
        ';



    if (isset($_SESSION['userid'])) {

        $likesql = mysqli_query($connect, "SELECT * FROM hati WHERE beritaid = $idberita AND userid = '" . $_SESSION['userid'] . "' AND komenid = $idkomen");
        $likekomen = mysqli_fetch_array($likesql);
    }

    // Cek login 
    if (isset($_SESSION['userid'])) {
        // Cek ada database
        if (isset($likekomen)) {
            // Cek status dengan userid spesifik login 
            if ($likekomen['status'] == 1 && $likekomen['userid'] == $_SESSION['userid']) {
                echo '
                    <div class="col-1 text-end">
                    <span class="liked">
                    </br>
                    <form action="./controller/like.php" method="POST">
                    <input type="hidden" name="idberita" value=' . $idberita . '>
                    <input type="hidden" name="idkomen" value=' . $idkomen . '>
                    <button class="likebutton" type="submit" name="unlike"><i class="bi bi-heart-fill"></i>
                    <div class="tglberita">' . $totalsuka[0] . ' </div></button>
                    </form> 
                    </span>';
            } else {
                echo '
                    <div class="col-1 text-end">
                    <span class="like">
                    </br>
                    <form action="./controller/like.php" method="POST">
                    <input type="hidden" name="idberita" value=' . $idberita . '>
                    <input type="hidden" name="idkomen" value=' . $idkomen . '>
                    <button class="likebutton" type="submit" name="unlike"><i class="bi bi-heart-fill"></i>
                    <div class="tglberita">' . $totalsuka[0] . ' </div></button>
                    </form> 
                    </span>';
            }
        } else {
            echo '
                <div class="col-1 text-end">
                <span class="like">
                </br>
                <form action="./controller/like.php" method="POST">
                <input type="hidden" name="idberita" value=' . $idberita . '>
                <input type="hidden" name="idkomen" value=' . $idkomen . '>
                <button class="likebutton" type="submit" name="like"><i class="bi bi-heart-fill"></i>
                <div class="tglberita">' . $totalsuka[0] . ' </div></button>
                </form> 
                </span>';
        }
    } else {
        echo '
                <div class="col-1 text-end">
                <span class="like">
                </br>
                <form action="./?open=login" method="POST">
                <input type="hidden" name="idberita" value=' . $idberita . '>
                <input type="hidden" name="idkomen" value=' . $idkomen . '>
                <button class="likebutton" type="submit" name="like"><i class="bi bi-heart-fill"></i>
                <div class="tglberita">' . $totalsuka[0] . ' </div></button>
                </form> 
                </span>';
    }


    echo '
            </div>
                </div>
                    

                <div class="clear"></div>
            ';
}
?>

<div class="clear"></div>