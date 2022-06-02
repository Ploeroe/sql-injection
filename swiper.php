<!--berita populer-->
<div class="headline  wow fadeInUp" data-wow-delay="0.8s">
    <h1 class="todaynews">Headline</h1>
    <div class="swiper">
        <div class="swiper-wrapper py-1 mb-2">
            <?php
            global $connect;

            $pop = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' AND Tanggal>='" . date('Y-m-d H:i:s', strtotime('' . POPULER_TIME . ' days')) . "' ORDER BY Viewnum DESC LIMIT 0,10");

            while ($r = mysqli_fetch_array($pop)) {
                extract($r);

                echo '
                
                
                <div class="swiper-slide" data-aos="fade-right"  data-aos-duration="1000">
                    <div class="populer-swiper">
                        <div class="img text-center">
                            <a href="./?open=detail&id=' . $ID . '">
                                <img src="' . URL_SITUS . $Gambar . '" class="img-swiper">
                                <h1 class="titleberita titleberita-swiper"><a href="./?open=detail&id=' . $ID . '">' . $Judul . '</a></h1>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                ';
            }

            ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <!--/berita populer-->
</div>
<?php
