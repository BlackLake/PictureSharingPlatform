﻿
<div class="anadiv" style="width: 1300px">
    <?php
    if (@$_SESSION['oturum']) {
        echo '<div style="border-radius: 4px ;width: 330px;height: 200px;border: solid 1px;position: absolute">
        <form action="yukle.php" enctype="multipart/form-data" method="post">
        <table style="width: 100%" cellspacing="5px">
        <tr><td colspan="2" align="center"><b>Yeni Paylaşım</b></td></tr>
        <tr>
        <td>Dosya: </td>
        <td><input style="border-radius: 4px" type="file" name="presim"></td>
        </tr>
        <tr>
        <td>Başlık: </td>
        <td><input name="baslik" style="width: 100%; border-radius: 4px; border:solid 1px #dddddd; line-height: 25px" type="text"></td>
        </tr>
        <tr>
        <td>Etiketler: </td>
        <td><input name="etiketler" style="width: 100%; border-radius: 4px; border:solid 1px #dddddd; line-height: 25px" type="text" placeholder="etiket1,etiket2,etiket3,etiket4"></td>
        </tr>
        <tr>
        <td colspan="2" align="center"><input class="btn" type="submit" name="paylas" value="Gönder!"></td>
        </tr>
        </table>
        </form>
        </div>';
    }

    ?>
    <?php
    //Paylaşımları Listelemek için
    //echo $_SESSION["kID"];
    if (isset($_GET['paylasimSayfa'])) {
        $paylasimSayfa = $_GET['paylasimSayfa'];
    } else {
        $paylasimSayfa = 1;
    }
    $paylasimSayfaBasina = 4;
    $paylasimSayfaBaslangic = ($paylasimSayfaBasina * $paylasimSayfa) - $paylasimSayfaBasina;
    if (@$_GET['sr'] == 1) {
        $siralamaTuru=1;
        $sorgu = mysqli_query($baglan, "SELECT
  paylasim.id_paylasim,
  paylasim.id_kullanici,
  paylasim.baslik,
  paylasim.resim_url,
  paylasim.etiket,
  paylasim.ptarih
FROM paylasim
  LEFT OUTER JOIN paylasim_begeni ON paylasim.id_paylasim = paylasim_begeni.id_paylasim
WHERE paylasim.ptarih BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
GROUP BY paylasim.id_paylasim
ORDER BY count(paylasim_begeni.id_paylasim) DESC LIMIT {$paylasimSayfaBaslangic},{$paylasimSayfaBasina}");
    } else{
        $siralamaTuru=2;
        $sorgu = mysqli_query($baglan, "SELECT * FROM 	paylasim ORDER BY ptarih DESC LIMIT {$paylasimSayfaBaslangic},{$paylasimSayfaBasina}");
    }



    while ($kayit = mysqli_fetch_array($sorgu)) {
        $sorguKul = mysqli_query($baglan, "SELECT * FROM 	kullanici WHERE id_kullanici='" . $kayit["id_kullanici"] . "'");
        $kayitKul = mysqli_fetch_array($sorguKul);
        echo '
    <div class="icerik"><div class="nick">';

        echo '<a href="profilDetay.php?profilID=' . $kayitKul['id_kullanici'] . '">' . $kayitKul["nick"] . '</a>';

        echo ' </div>
	<div class="icerik_sol">

        <img height="80" width="80" src="' . $kayitKul["resim_url"] . '" title="Paylaşan"/>';
        if(@$_SESSION['oturum']==true){

            echo '
        <div class="profilBegeni">
                <form method="post">
                    <input type="text" style="visibility: hidden; position:absolute;"  name="begenilenID" id="begenilenID" value="' . $kayitKul['id_kullanici'] . '">
                    <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION['kID'] . '">
                    <input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $kayit['id_paylasim'] . '">
                    <input type="text" style="visibility: hidden; position:absolute;"  name="nereden" id="nereden" value="index">';
            $profilBegeniSorgu = mysqli_query($baglan, "SELECT * FROM kullanici_begeni WHERE id_begenilen = {$kayitKul['id_kullanici']} AND id_begenen = {$_SESSION['kID']}");
            $profilBegeniSayi = mysqli_num_rows($profilBegeniSorgu);
            if($profilBegeniSayi>0){
                echo '<input type="submit" class="btn" id="profilBegeniBTN" name="profilBegeniBTN" value="Saygınlık Al">';
            }
            else{
                echo '<input type="submit" class="btn" id="profilBegeniBTN" name="profilBegeniBTN" value="Saygınlık Ver">';
            }
            if(@$_SESSION['yetki']==1){
                echo '<input type="submit" class="btn" id="banBTN" name="banBTN" value="Banla">
                     <input type="submit" class="btn" id="kaldirBTN" name="kaldirBTN" value="Kaldır">';
            }

            echo '
        </form>
            </div>';
        }

        echo '


	</div>

	<div class="icerik_sag">
	<h3>' . $kayit["baslik"] . '</h3>
	<img src="' . $kayit["resim_url"] . '" width="500px"/>
	<ul>';

        $etiketler = explode(",", $kayit["etiket"]);
        $i = 0;
        //echo 'UZUNLUK'.count($etiketler);
        while ($i < count($etiketler)) {
            echo '<a class="begenionizlenick" href="arama.php?metin=' . $etiketler[$i] . '">#' . $etiketler[$i] . ' </a>' . '  ';
            $i++;
        }
        echo '</ul>
    <a class="yorumgor" href="paylasimDetay.php?id=' . $kayit["id_paylasim"] . '">Yorumları Gör</a><br/><br/>';
        $begeniOnizleSorgu = mysqli_query($baglan, "
SELECT
  paylasim_begeni.id_kullanici,
  kullanici.nick
FROM paylasim_begeni
  LEFT JOIN kullanici ON paylasim_begeni.id_kullanici = kullanici.id_kullanici
WHERE paylasim_begeni.id_paylasim = {$kayit['id_paylasim']}");
        if ($begeniOnizleSorgu) {
            echo 'Beğenenler: ';
        }
        $sayac = 0;
        while ($begeniKayit = mysqli_fetch_array($begeniOnizleSorgu)) {
            echo '<a class="begenionizlenick" href="profilDetay.php?profilID=' . $begeniKayit["id_kullanici"] . '">' . $begeniKayit["nick"] . '</a>';
            $sayac++;
            if ($sayac == 4) {
                echo ' ve ' . (mysqli_num_rows($begeniOnizleSorgu) - 4) . ' kişi daha...';
                break;
            }
            if ($sayac < 4) {
                echo ' ,';
            }
        }
        if (@$_SESSION['oturum'] == true) {
            include "begeni_islemler.php";
            $pbegenisorgu = mysqli_query($baglan, "SELECT * FROM paylasim_begeni WHERE id_kullanici={$_SESSION['kID']} AND id_paylasim={$kayit['id_paylasim']}");
            $pbegenisonuc = mysqli_num_rows($pbegenisorgu);
            if ($pbegenisonuc > 0) {
                echo '
                <form method="post" style="float: left; margin-top: -6px;">
                <input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $kayit['id_paylasim'] . '">
                <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION['kID'] . '">
                <input class="btn" name="paylasimBegeniBTN" id="paylasimBegeniBTN" type="submit" value="Beğenmekten Vazgeç">&nbsp
                </form>
                ';
            } else {
                echo '
                <form method="post" style="float: left; margin-top: -6px;">
                <input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $kayit['id_paylasim'] . '">
                <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION['kID'] . '">
                <input class="btn" name="paylasimBegeniBTN" id="paylasimBegeniBTN" type="submit" value="Beğen">&nbsp
                </form>
                ';
            }
        }
        include "yorum_yap.php";
        echo '
	<div class="text">
    <div id="response" class="response">  </div>
    <form method="post">
        <textarea name="yorumIcerik"></textarea><br>
        <input type="text" style="visibility: hidden; position:absolute;" class="from" name="from" id="from" value="homepage">
        <input type="text" style="visibility: hidden; position:absolute;" class="paylasimID" name="paylasimID" id="paylasimID" value="' . $kayit['id_paylasim'] . '">
        <input type="submit" value="Yorum Yap" name="yorumBTN" id="yorumBTN" class="yorum yorumBTN">
    </form>
	</div>
	</div>
    </div>';
    }

    ?>
<div class="icerik">
    <?php

    $toplamSayfaSorgu = mysqli_query($baglan, "select count(*) as toplamsayi from paylasim");
    $toplamSayfa = mysqli_fetch_array($toplamSayfaSorgu);
    echo '<div class="paylasimSayfala">';
    for ($i = 0; $i < ceil($toplamSayfa['toplamsayi'] / 4); $i++) {
        echo '<a class="yorumgor" href="index.php?sr=' . $siralamaTuru . '&paylasimSayfa=' . ($i + 1) . '">' . ($i + 1) . '</a>';
    }
    echo '</div>';
    ?>
</div>
</div>