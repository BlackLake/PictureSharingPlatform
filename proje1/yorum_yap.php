<?php
include_once "baglanti.php";


if (@$_POST['yorumBTN']) {
    if (@$_SESSION['oturum']) {
        $kID = $_SESSION['kID'];
        $paylasimID = $_POST['paylasimID'];
        $yorumIcerik = $_POST['yorumIcerik'];
        $tarih = date("Y-m-d", time());
        $sorgu = mysqli_query($baglan, "INSERT INTO paylasim_yorum (id_yorum,id_paylasim,id_kullanici,yorum,tarih) VALUES (NULL , '$paylasimID', '$kID','$yorumIcerik', '$tarih')");
        if(@$_POST['from']=="homepage"){
            header("refresh:0; url=paylasimDetay.php?id=" . $paylasimID);
        }
        else{

        }

    } else {
        echo "<script>  alert('LÜTFEN ÜYE GİRİŞİ YAPINIZ...');
		    window.location='uye_giris.php';

		     </script> ";
    }
}


?>