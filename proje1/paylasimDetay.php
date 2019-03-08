<!DOCTYPE HTML SYSTEM>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Resim Blog</title>
</head>
<body>
<?php
session_start();
include "baglanti.php";
include "header.php";
include "begeni_islemler.php";
include "yorum_yap.php";
$paylasimId = @$_GET['id'];
$tarih = date("Y-m-d H:i:s");
if (isset($_GET['yorumSayfa'])) {
    $yorumSayfa = $_GET['yorumSayfa'];
} else {
    $yorumSayfa = 1;
}
$yorumSayfaBasina = 4;
$yorumSayfaBaslangic = ($yorumSayfaBasina * $yorumSayfa) - $yorumSayfaBasina;

$sorgu = mysqli_query($baglan, "select * from 	paylasim WHERE id_paylasim='$paylasimId'");
$kayit = mysqli_fetch_array($sorgu);
//$kullanici=$kayit["id_kullanici"];

$sorguKul = mysqli_query($baglan, "SELECT * FROM 	kullanici WHERE id_kullanici='" . $kayit["id_kullanici"] . "'");
$kayitKul = mysqli_fetch_array($sorguKul);
?>
<br/>
<div class="anadiv">
    <div class="icerik">
        <div class="nick">

            <?php echo $kayitKul["nick"]; ?>

        </div>
        <div class="icerik_sol">
            <img height="80" width="80" src="<?php echo $kayitKul["resim_url"]; ?>" title="Paylaşan"/>
            <?php
            if (@$_SESSION['oturum'] == true) {
                echo '
            <div class="profilBegeni">
                <form method="post">
                        <input type="text" style="visibility: hidden; position:absolute;"  name="begenilenID" id="begenilenID" value="' . $kayit["id_kullanici"] . '">
                        <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION["kID"] . '">
                    <input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $paylasimId . '">
                    <input type="text" style="visibility: hidden; position:absolute;"  name="nereden" id="nereden" value="paydetay">';


                $profilBegeniSorgu = mysqli_query($baglan, "SELECT * FROM kullanici_begeni WHERE id_begenilen = {$kayit['id_kullanici']} AND id_begenen = {$_SESSION['kID']}");
                $profilBegeniSayi = mysqli_num_rows($profilBegeniSorgu);
                if ($profilBegeniSayi > 0) {
                    echo '<input type="submit" class="btn" id="profilBegeniBTN" name="profilBegeniBTN" value="Saygınlık Al">';
                } else {
                    echo '<input type="submit" class="btn" id="profilBegeniBTN" name="profilBegeniBTN" value="Saygınlık Ver">';
                }
                echo '

                </form>
            </div>

            ';
            }


            ?>


        </div>


        <div class="icerik_sag">

            <h3><?php echo $kayit["baslik"]; ?></h3>
            <img src="<?php echo $kayit["resim_url"]; ?>" width="500px"/>
            <ul>
                <?php
                //ETİKETLER İÇİN
                $etiketler = explode(",", $kayit["etiket"]);
                $i = 0;

                while ($i < count($etiketler)) {
                    echo '<a class="begenionizlenick" href="arama.php?metin=' . $etiketler[$i] . '">#' . $etiketler[$i] . ' </a>' . '  ';
                    $i++;
                }


                ?>
            </ul>

            <?php
            if (@$_SESSION['oturum'] == true) {
                include "begeni_islemler.php";
                $pbegenisorgu = mysqli_query($baglan, "SELECT * FROM paylasim_begeni WHERE id_kullanici={$_SESSION['kID']} AND id_paylasim={$paylasimId}");
                $pbegenisonuc = mysqli_num_rows($pbegenisorgu);
                if ($pbegenisonuc > 0) {
                    echo '
                <form method="post" style="float: left; margin-top: -6px;">
                <input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $paylasimId . '">
                <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION['kID'] . '">
                <input class="btn" name="paylasimBegeniBTN" id="paylasimBegeniBTN" type="submit" value="Beğenmekten Vazgeç">
                </form>
                ';
                } else {
                    echo '
                <form method="post" style="float: left; margin-top: -6px;">
                <input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $paylasimId . '">
                <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION['kID'] . '">
                <input class="btn" name="paylasimBegeniBTN" id="paylasimBegeniBTN" type="submit" value="Beğen">
                </form>
                ';
                }
                echo '<br/>';
            }
            ?>


            <div class="text">
                <?php
                //Yorumlar için
                //Başla

                if ($paylasimId) {
                    $sorgu = mysqli_query($baglan, "select paylasim_yorum.id_yorum,paylasim_yorum.id_paylasim,paylasim_yorum.id_kullanici,paylasim_yorum.yorum,paylasim_yorum.tarih
from 	paylasim_yorum LEFT OUTER JOIN paylasim_yorum_begeni
    ON paylasim_yorum.id_yorum=paylasim_yorum_begeni.id_yorum
WHERE id_paylasim='$paylasimId' GROUP BY paylasim_yorum.id_yorum
ORDER BY COUNT(paylasim_yorum_begeni.id_yorum) DESC LIMIT {$yorumSayfaBaslangic},{$yorumSayfaBasina}");

                    while ($kayit = mysqli_fetch_array($sorgu)) {


                        $sorguKulTumu = mysqli_query($baglan, "SELECT * FROM kullanici ");
                        $sorguPaylasanTumu = mysqli_fetch_array($sorguKulTumu);
                        //sorgu2 varsa bu yorum begenilmiştir demektir.
                        $sorgu2 = mysqli_query($baglan, "SELECT * FROM 	paylasim_yorum_begeni  WHERE  id_kullanici='" . @$_SESSION["kID"] . "'  AND id_yorum='" . $kayit["id_yorum"] . "' ");

                        $sorguKul = mysqli_query($baglan, "SELECT * FROM kullanici WHERE id_kullanici='" . $kayit["id_kullanici"] . "'  ");
                        $sorguPaylasan = mysqli_fetch_array($sorguKul);
                        echo ' <div class="text">
 							<table border="0">
							  <tr>
								<td width="86" rowspan="3"> <img src="' . $sorguPaylasan["resim_url"] . '" width="50px" height="50px"/> </td>
								<td colspan="2"><a style="text-decoration: none;color: black;" href="profilDetay.php?profilID=' . $sorguPaylasan["id_kullanici"] . '">' . $sorguPaylasan["nick"] . '</a></td>
							  </tr>
							  <tr>
								<td colspan="2">' . $kayit["yorum"] . '</td>
							  </tr>
							  <tr>
								<td >
									<form name="form1" method="post" >

									<input type="text" style="visibility: hidden; position:absolute;"  name="yorumID" id="yorumID" value="' . $kayit["id_yorum"] . '">
									<input type="text" style="visibility: hidden; position:absolute;"  name="paylasimID" id="paylasimID" value="' . $kayit["id_paylasim"] . '">
									<input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="';
                        echo @$_SESSION["kID"];
                        echo '">';
                        if (@$_SESSION["oturum"]) {
                            echo '
													  <input type="submit" class="btn" name="yorumBegeniBTN" id="yorumBegeniBTN" value="';
                            $say = mysqli_num_rows($sorgu2);
                            if ($say > 0)
                                echo 'Begenmekten Vazgeç ">';
                            else
                                echo 'Begen ">';
                            if (@$_SESSION['yetki'] == 1) {
                                echo '<input type="submit" class="btn" id="yorumKaldirBTN" name="yorumKaldirBTN" value="Yorum Kaldır">';
                            }

                        }
                        $sorguBegeniSayisi = mysqli_query($baglan, "SELECT * FROM 	paylasim_yorum_begeni  WHERE   id_yorum='" . $kayit["id_yorum"] . "' ");
                        $say = mysqli_num_rows($sorguBegeniSayisi);
                        if ($say > 0)
                            echo "<b> Begeni(" . $say . ")</b>";
                        else
                            echo "<b> Begeni(0) </b>";

                        echo '

								  <div id="response">  </div>
								</form></td>
								<td width="90">' . $kayit["tarih"] . '</td>
							  </tr>
							</table>



					  </div>

					  ';

                    }
                }
                ///Bitir


                ?>

                <?php

                $toplamYorumSorgu = mysqli_query($baglan, "select count(*) as toplamsayi from paylasim_yorum WHERE id_paylasim='$paylasimId'");
                $toplamYorum = mysqli_fetch_array($toplamYorumSorgu);
                echo '<center>';
                for ($i = 0; $i < ceil($toplamYorum['toplamsayi'] / 4); $i++) {
                    echo '<a class="yorumgor" href="paylasimDetay.php?id=' . $paylasimId . '&yorumSayfa=' . ($i + 1) . '">' . ($i + 1) . '</a>';
                }
                echo '</center>';
                ?>
                <div class="text">
                    <div id="response" class="response"></div>
                    <form method="post">
                        <textarea name="yorumIcerik"></textarea><br>
                        <input type="text" style="visibility: hidden; position:absolute;" class="paylasimID"
                               name="paylasimID" id="paylasimID" value="<?php echo $paylasimId; ?>">
                        <input type="text" style="visibility: hidden; position:absolute;" class="kullaniciID"
                               name="kullaniciID" id="kullaniciID" value="'.@$_SESSION[" id"].'">
                        <input type="submit" value="Yorum Yap" name="yorumBTN" id="yorumBTN" class="yorum yorumBTN">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
</body>
</html>
