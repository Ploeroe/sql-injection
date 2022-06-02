<div class="boxkomen mt-5 wow fadeInUp" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="titlekomen" for='komen'>COMMENT</h1>
    <hr style="color: #07949e !important;">
    <?php
    include "komentar.php";
    ?>
    <br>
    <form action="./controller/addkomen.php" method="POST">
        <input type="hidden" name="idberita" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="komenid">
        <input class="kotakinput" type='text' name='komen' placeholder='Your comment...' id="input">
        <button class="btnsignup mt-2" type='submit' name="comment">Comment</button>
    </form>
</div>
<div class="clear"></div>