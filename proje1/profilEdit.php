<?php
/**
 * Created by PhpStorm.
 * User: Furkan
 * Date: 14.5.2016
 * Time: 21:22
 */

if(@$_POST['guncelle']&&$_SESSION['oturum']==true){
    $kullaniciID = $_SESSION['kID'];
    $resim = $_FILES["profilResim"]["tmp_name"];
    $name = $_FILES["profilResim"]["name"];
    $son = @substr($name, strlen($name) - 4, 4);
    $yeniad = "profil/" . md5($name) . @$son;


    if (!file_exists($yeniad)) {

        if ($son == ".jpg" || $son == ".png" || $son == ".jpeg" || $son == ".gif") {

            if (move_uploaded_file($resim, $yeniad)) {
                $sorgu2=mysqli_query($baglan,"SELECT resim_url FROM kullanici WHERE id_kullanici='$kullaniciID'");
                $sorgu2sonuc=mysqli_fetch_array($sorgu2);
                $sorgu = mysqli_query($baglan, "UPDATE kullanici SET resim_url='$yeniad' WHERE id_kullanici='$kullaniciID'");
                unlink($sorgu2sonuc['resim_url']);
                header("refresh:0; url=profilDetay.php?profilID=".$_SESSION['kID']);
            }
        } else {

            echo "Resim dosyasi oldugundan emin olun!!!";
        }
    } else {
        echo "Dosyaniz Mevcut Zaten!!!";
    }
}
?>