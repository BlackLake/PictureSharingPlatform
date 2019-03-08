<?php
session_start();
if (@$_SESSION['oturum'] == true) {
    if (@$_POST['etiketler'] && @$_POST['baslik']) {
        require "baglanti.php";
        $etiketler = $_POST["etiketler"];
        $baslik = $_POST['baslik'];
        $kullaniciID = $_SESSION['kID'];
        $resim = $_FILES["presim"]["tmp_name"];
        $name = $_FILES["presim"]["name"];
        $son = @substr($name, strlen($name) - 4, 4);
        $yeniad = "resim/" . md5($name) . @$son;
        $ptarih = date("Y-m-d H:i:s", time());


        if (!file_exists($yeniad)) {

            if ($son == ".jpg" || $son == ".png" || $son == ".jpeg" || $son == ".gif") {

                if (move_uploaded_file($resim, $yeniad)) {
                    $sorgu = mysqli_query($baglan, "INSERT INTO paylasim (id_paylasim,id_kullanici,baslik,resim_url,etiket,ptarih) VALUES (NULL ,'$kullaniciID','$baslik','$yeniad','$etiketler','$ptarih')");
                    echo "Resim Dosyaniz Basariyla Yuklendi, 2 saniye içerisinde yönlendirileceksiniz";
                    header("refresh:2; url=index.php");
                }
            } else {

                echo "Resim dosyasi oldugundan emin olun!!!";
            }
        } else {
            echo "Dosyaniz Mevcut Zaten!!!";
        }
    } else
        echo 'Başlık ve Etiket girmediniz!!';

} else {
    include "uye_giris.php";
}
?>