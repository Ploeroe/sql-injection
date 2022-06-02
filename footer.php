	</div>

	</div>

	  <?php
			$open = (isset($_GET["open"]) ? $_GET["open"] : '');
			if ($open !== "login" && $open !== "signup") {
		?>
	<footer>
	  <div class="footer py-5 mt-5">
	    <div class="row">
	      <div class="col-4 mt-3">
	        <img src="image/title.png" alt="" width="300">
	        <p class="titlefooter">Your daily news</p>
	      </div>
	      <div class="col-2 mt-3 ">
	        <div class="text-start footerlink">
	          <h4 class="titlefooter">Our News</h4>
	          <i class="bi bi-play-fill "></i><a href="./"> Home</a><br>
	          <?php
            global $connect;

            $menu = mysqli_query($connect, "SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID ASC LIMIT 0,10");
            while ($r = mysqli_fetch_array($menu)) {
              extract($r);

              echo '
              <i class="bi-play-fill"></i><a href="./?open=cat&id=' . $ID . '"> ' . $Kategori . '</a><br>
							';
            }

            ?>
	        </div>
	      </div>
	      <div class="col-2 mt-3">
	        <div class="text-start">
	          <h4 class="titlefooter">Contact Us</h4>
	          <p>
	            <i class="bi bi-instagram"></i> : @gercepnews <br>
	            <i class="bi bi-telephone"></i> : (021) 5423537 <br>
	            <i class="bi bi-envelope"></i> : gercepnews@my.id
	          </p>
	        </div>
	      </div>
	      <div class="col-4 mt-3">
	        <div class="text-start">
	          <h4 class="titlefooter">Our Location</h4>
	          <p>
	            <i class="bi bi-house-door"></i> Jalan Batu Nunggal No. 26 Jakarta Selatan <br>
	            <i class="bi bi-house-door"></i> Discovery Place Blok A3 No. 77 Surakarta <br>
	            <i class="bi bi-house-door"></i> Jl Guru Patimpus Deli Plaza, Sumatera Utara
	          </p>
	        </div>
	      </div>
	    </div>
	</div>
</footer>
<?php } ?>

	<script>
	  const swiper = new Swiper('.swiper', {
	    // Optional parameters
	    direction: 'horizontal',
	    loop: true,
	    autoplay: {
	      delay: 2500,
	    },
	    // autoHeight: true,
	    slidesPerView: 3,
	    spaceBetween: 30,
	    height: 40,
	    // If we need pagination
	    pagination: {
	      el: '.swiper-pagination',
	    },

	    // Navigation arrows
	    navigation: {
	      nextEl: '.swiper-button-next',
	      prevEl: '.swiper-button-prev',
	    },
	    breakpoints: {
	      499: {
	        slidesPerView: 1,
	        spaceBetweenSlides: 30
	      },
	      1000: {
	        slidesPerView: 2,
	        spaceBetweenSlides: 40
	      },
	      1200: {
	        slidesPerView: 3,
	        spaceBetweenSlides: 30
	      },
	    }

	    // And if we need scrollbar

	  });
	</script>
	<script src="./controller/wow.min.js"></script>
	<script>
	  new WOW().init();
	</script>
	<script>
	  AOS.init();
	</script>
			<script>
			window.onscroll = function() {
				scrollFunction()
			};

			function scrollFunction() {
				if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
					document.getElementById("nav").style.padding = "0px";
				} else {
					document.getElementById("nav").style.padding = "5px";
				}
			}

			
		</script>
	</body>

	</html>