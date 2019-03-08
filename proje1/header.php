<div class="header">

    <div class="menu">

        <ul>
            <li><img src="img/logo.png"></li>
            <li><a href="index.php?sr=1">Trending</a></li>
            <li><a href="index.php?sr=2">Yeniler</a></li>
            <li><a href="">Bölümler</a></li>
            <form method="get" action="arama.php">
                <li><input name="metin" type="text" placeholder="arama" style="margin-top: 12px"></li>
                <li><input class="btn" type="submit" value="Ara!" style="margin-top: 12px"></li>
            </form>
            <li><a href="" style="padding: 0;"><img src="fb.png"></a></li>
            <li><a href="" style="padding: 0;"><img src="img/tw.png"></a></li>
            <li><a href="iletisim.php" style="padding: 0;"><img src="img/mail.png"></a></li>
            <li><?php
                @session_start();
                if (@$_SESSION['oturum'] == false) {
                    echo '<a href="uye_ol.php" title="Üye Ol">Üye Ol</a>';//Oturum Açık Değilse

                }
                if (@$_SESSION['oturum'] == true) {
                    echo '<a href="profilDetay.php?profilID=' . $_SESSION['kID'] . '" title="Hesap">Hesap</a>'; //Oturum Açıksa
                }
                ?>
            </li>
            <li>
                <?php
                @session_start();
                if (@$_SESSION['oturum'] == true) {
                    echo '<a href="uye_cikis.php" title="Üye Çıkış">Çıkış</a>'; //Oturum Açıksa
                }
                if (@$_SESSION['oturum'] == false) {
                    echo '<a href="uye_giris.php" title="Üye Giriş">Giriş</a>';//Oturum Açık Değilse

                }
                ?>
            </li>
        </ul>

    </div>

</div>