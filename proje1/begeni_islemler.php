<?php
include "baglanti.php";
$yorumID = @$_POST['yorumID'];
$paylasimID = @$_POST['paylasimID'];
$begenilenID = @$_POST['begenilenID'];

$kullaniciID = @$_SESSION['kID'];
//echo $kullaniciID;

if (@$_POST['yorumBegeniBTN']) {
    //echo  "yorumID".$yorumID."<br/>"."paylasimID".$paylasimID."<br/>"."kullaniciID".$kullaniciID."<br/>";
    $sorgu = mysqli_query($baglan, "select * from 	paylasim_yorum_begeni  WHERE id_kullanici='$kullaniciID' AND id_yorum='$yorumID' ");
    $say = mysqli_num_rows($sorgu);
    if ($say > 0) {
        //echo "SİL";
        mysqli_query($baglan, "DELETE  FROM 	paylasim_yorum_begeni  WHERE id_kullanici='$kullaniciID' AND id_yorum='$yorumID' ");
        header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
        exit();
    } else {
        //echo "EKLE";
        mysqli_query($baglan, "INSERT INTO  	paylasim_yorum_begeni  (id_begeni,id_yorum,id_kullanici) VALUES (NULL,'$yorumID','$kullaniciID')");
        header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
        exit();
    }
} else if (@$_POST['profilBegeniBTN']) {
    if ($begenilenID !== $kullaniciID) {
        $sorgu = mysqli_query($baglan, "SELECT * FROM kullanici_begeni WHERE id_begenilen='$begenilenID' AND id_begenen='$kullaniciID'");
        $say = mysqli_num_rows($sorgu);
        if ($say > 0) {
            mysqli_query($baglan, "DELETE FROM kullanici_begeni WHERE id_begenilen='$begenilenID' AND id_begenen='$kullaniciID'");
            if ($_POST['nereden'] == "paydetay") {
                header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
                exit();
            } elseif ($_POST['nereden'] == "profil") {
                header("refresh:0; url=profilDetay.php?profilID=" . $begenilenID);
                exit();
            } else {
                header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
                exit();
            }

        } else {
            mysqli_query($baglan, "INSERT INTO kullanici_begeni (id_begeni, id_begenilen, id_begenen) VALUES (NULL, '$begenilenID', '$kullaniciID')");
            if ($_POST['nereden'] == "paydetay") {
                header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
                exit();
            } elseif ($_POST['nereden'] == "profil") {
                header("refresh:0; url=profilDetay.php?profilID=" . $begenilenID);
                exit();
            } else {
                header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
                exit();
            }
        }
    } else
        echo '<script>window.alert("Kendini Beğenmiş :D")</script>';
    header("refresh:0; url=index.php");
    exit();
} else if (@$_POST['paylasimBegeniBTN']) {

    $sorgu = mysqli_query($baglan, "SELECT * FROM paylasim_begeni WHERE id_paylasim='$paylasimID' AND id_kullanici='$kullaniciID'");
    $say = mysqli_num_rows($sorgu);

    if ($say > 0) {
        mysqli_query($baglan, "DELETE FROM paylasim_begeni WHERE id_paylasim='$paylasimID' AND id_kullanici='$kullaniciID'");
        header("refresh:0; url=index.php");
        exit();
    } else {
        mysqli_query($baglan, "INSERT INTO paylasim_begeni (id_begeni,id_paylasim,id_kullanici) VALUES (NULL ,'$paylasimID','$kullaniciID')");
        header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
        exit();
    }


} elseif (@$_POST['banBTN']) {
    if (@$_SESSION['yetki' == 1]) {
        mysqli_query($baglan, "UPDATE paylasim SET id_kullanici='18' WHERE id_kullanici='$begenilenID';");
        mysqli_query($baglan, "DELETE FROM kullanici WHERE id_kullanici='$begenilenID'");
        header("refresh:0; url=index.php");
        exit();
    } else {
        exit();
    }

} elseif (@$_POST['kaldirBTN']) {
    if (@$_SESSION['yetki'] == 1) {
        $yorumbegenilersorgu = mysqli_query($baglan, "SELECT id_yorum FROM paylasim_yorum WHERE id_paylasim='$paylasimID'  ");
        while ($yorumbegenikayit = mysqli_fetch_array($yorumbegenilersorgu)) {
            mysqli_query($baglan, "DELETE FROM paylasim_yorum_begeni WHERE id_yorum={$yorumbegenikayit['id_yorum']}");
        }
        mysqli_query($baglan, "DELETE FROM paylasim_yorum WHERE id_paylasim='$paylasimID'");
        mysqli_query($baglan, "DELETE FROM paylasim_begeni WHERE id_paylasim='$paylasimID'");
        mysqli_query($baglan, "DELETE FROM paylasim WHERE id_paylasim='$paylasimID'");
        header("refresh:0; url=index.php");
        exit();
    } else {
        exit();
    }
} elseif (@$_POST['yorumKaldirBTN']) {
    if (@$_SESSION['yetki'] == 1) {
        mysqli_query($baglan, "DELETE FROM paylasim_yorum_begeni WHERE id_yorum='$yorumID'");
        mysqli_query($baglan, "DELETE FROM paylasim_yorum WHERE id_yorum='$yorumID'");
        header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
        exit();
    } else {
        exit();
    }
}


?>

