<!DOCTYPE HTML SYSTEM>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Resim Blog</title>
</head>
<body>
<?php
include "baglanti.php";
include "header.php";
include "begeni_islemler.php";
include "profilEdit.php";
if (@$_SESSION['oturum'] == true) {
    $profilID = $_GET['profilID'];
    $profilSorgu = mysqli_query($baglan, "SELECT * FROM kullanici WHERE id_kullanici = '$profilID'");
    $profilDetay = mysqli_fetch_array($profilSorgu);
    $profilBegeniDetaySorgu = mysqli_query($baglan, "SELECT * FROM kullanici_begeni WHERE id_begenilen='$profilID'");
    $profilBegeniDetaySayi = mysqli_num_rows($profilBegeniDetaySorgu);
    echo '<div class="anadiv">
    <div class="profilContainer">
        <div class="nick">
            ' . $profilDetay['nick'] . '
        </div>
        <div class="profilResmi">
            <img width="80" height="80" src="' . $profilDetay['resim_url'] . '">
        </div>
        <div class="profilBilgiler">
            Hesap Bilgileri<br>
            <center>
                    <table cellspacing="10">
                        <tr>
                            <td>Ad:</td>
                            <td>' . $profilDetay['ad'] . '</td>
                        </tr>
                        <tr>
                            <td>Nickname:</td>
                            <td>' . $profilDetay['nick'] . '</td>
                        </tr>
                        <tr>
                            <td>e-Mail:</td>
                            <td>' . $profilDetay['email'] . '</td>
                        </tr>
                        <tr>
                            <td>Saygınlık Puanı:</td>
                            <td>' . $profilBegeniDetaySayi . '</td>
                        </tr>
                        ';
    if ($_SESSION['kID'] == $profilID) {
        echo '
                        <tr>
                            <td>Soyad</td>
                            <td>' . $profilDetay['soyad'] . '</td>
                        </tr>
                        <tr>
                            <td>Parola</td>
                            <td>' . $profilDetay['parola'] . '</td>
                        </tr>
                        <form method="post" enctype="multipart/form-data">
                        <tr>
                            <td>Profil Resmi:</td>
                            <td><input name="profilResim" type="file"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input class="btn" id="guncelle" name="guncelle" type="submit"></td>
                        </tr>
                        </form>';
    } else {

        echo '
            <tr>
                <form method="post">
                <td colspan="2" align="center">
                <input type="text" style="visibility: hidden; position:absolute;"  name="begenilenID" id="begenilenID" value="' . $profilID . '">
                <input type="text" style="visibility: hidden; position:absolute;"  name="kullaniciID" id="kullaniciID" value="' . $_SESSION['kID'] . '">
                <input type="text" style="visibility: hidden; position:absolute;"  name="nereden" id="nereden" value="profil">
                <input type="submit" class="btn" id="profilBegeniBTN" name="profilBegeniBTN" value="';
        $profilBegeniSorgu = mysqli_query($baglan, "SELECT * FROM kullanici_begeni WHERE id_begenilen = '$profilID' AND id_begenen = {$_SESSION['kID']}");
        $profilBegeniSayi = mysqli_num_rows($profilBegeniSorgu);
        if ($profilBegeniSayi > 0) {
            echo 'Saygınlık Al"></td>
            </form>
            </tr>
            ';
        } else {
            echo 'Saygınlık Ver"></td>
            </form>
            </tr>
            ';
        }

    }
    echo '
                    </table>
            </center>
        </div>
    </div>
</div>';
} else
    echo '<center><h1>Yetkiniz Yok!</h1></center>';

?>

</body>
</html>
