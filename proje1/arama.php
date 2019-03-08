<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Resim Blog Arama</title>
    <meta charset="utf-8"/>


</head>
<body>
<?php
session_start();
include "baglanti.php";
include "header.php";
?>
﻿
<div class="anadiv" style="width: 1300px">
    <?php

    if(@$_SESSION['oturum']!==true){
        header("refresh:0; url=uye_giris.php");
        exit();
    }

    //Paylaşımları Listelemek için
    //echo $_SESSION["kID"];
    $metin=$_GET['metin'];
    $sorgu = mysqli_query($baglan, "SELECT * FROM 	paylasim WHERE baslik LIKE '%$metin%' OR etiket LIKE '%$metin%' ORDER BY ptarih ASC");


    while ($kayit = mysqli_fetch_array($sorgu)) {
        $sorguKul = mysqli_query($baglan, "SELECT * FROM 	kullanici WHERE id_kullanici='" . $kayit["id_kullanici"] . "'");
        $kayitKul = mysqli_fetch_array($sorguKul);
        echo '
    <div class="icerik"><div class="nick">';

        echo '<a href="profilDetay.php?profilID=' . $kayitKul['id_kullanici'] . '">' . $kayitKul["nick"] . '</a>';

        echo ' </div>
	<div class="icerik_sol">

        <img src="' . $kayitKul["resim_url"] . '" title="Paylaşan"/>
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

        echo '
        </form>
            </div>


	</div>

	<div class="icerik_sag">
	<h3>' . $kayit["baslik"] . '</h3>
	<img src="' . $kayit["resim_url"] . '" width="500px"/>
	<ul>';

        $etiketler = explode(",", $kayit["etiket"]);
        $i = 0;
        //echo 'UZUNLUK'.count($etiketler);
        while ($i < count($etiketler)) {
            echo $etiketler[$i] . ' ';
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

</div>

</body>
</html>