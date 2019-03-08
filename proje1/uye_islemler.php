<?php
include "baglanti.php";
session_start();                //session  başladı oturum  yani
//error_reporting(0);				//Gürünecek olan hataları yok eder.Yani hatayi  yol sayar.


$kullaniciAd = @$_POST["kullaniciAd"];
$kullaniciSoyad = @$_POST["kullaniciSoyad"];
$nick = @$_POST["nick"];
$password = @$_POST["password"];
$email = @$_POST["email"];

//Üye Olmak İçin
//Başla
if (@$_POST["uyeOl"]) {
    echo "$nick";

    $sorgu = mysqli_query($baglan, " SELECT * FROM kullanici  WHERE  nick='$nick' ");
    if (mysqli_num_rows($sorgu) <= 0) {
        mysqli_query($baglan, "INSERT INTO kullanici (ad,soyad,nick,parola,email) VALUES ('$kullaniciAd','$kullaniciSoyad','$nick','$password','$email')");

        echo "<center><h1>Başarılı bir şekilde üye oldunuz!</h1></center>";
        header("refresh:2; url=index.php");
        exit();

    } else {
        echo "<center><h1>Üyelik Oluşturulamadı!</h1></center>";
        header("refresh:2; url=uye_ol.php");
        exit();
    }
}
//Bitir

//Üye Girişi İçin
//Başla

if (@$_POST["uyeGiris"]) {
    $sorgu1 = mysqli_query($baglan, "SELECT * FROM kullanici WHERE  nick = '$nick' AND  parola ='$password'  ");

    // echo $sorgu1;
    $say = mysqli_num_rows($sorgu1);
    // echo "say".$say;
    if ($say > 0) {

        $satir = mysqli_fetch_array($sorgu1);
        $_SESSION["kID"] = $satir["id_kullanici"];
        $_SESSION["ad"] = $satir["ad"];
        $_SESSION["soyad"] = $satir["soyad"];
        $_SESSION["nick"] = $satir["nick"];
        $_SESSION["password"] = $satir["parola"];
        $_SESSION["eposta"] = $satir["email"];
        $_SESSION["url"] = $satir["resim_url"];
        $_SESSION["yetki"] = $satir["yetki"];
        $_SESSION["oturum"] = true;


        echo "<center><h1>Başarılı bir şekilde giriş yaptınız!</h1></center>";
        header("refresh:2; url=index.php");
        exit();

    }


    if ($say <= 0) {
        echo "<center><h1>Giriş Başarısız!</h1></center>";
        header("refresh:2; url=uye_giris.php");
        exit();


    }


    if ($_SESSION["oturum"] != true) {
        echo "<center><h1>Giriş Başarısız!</h1></center>";
        header("refresh:2; url=uye_giris.php");
        exit();

    }


}


//Bitir

?>