<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Resim Blog</title>
    <meta charset="utf-8"/>
</head>
<body>
<?php
include  "baglanti.php";
include "header.php";
?>
<div class="anadiv">

<div class="formdiv">
<form id="form1" name="form1" method="post" action="uye_islemler.php" >
    <center><p>ÜYE OL</p></center>
    <table width="100%" border="0">
        <tbody>
        <tr>

            <td width="75"><p>Adınız :</p><input type="text" name="kullaniciAd" ></td>
        </tr>
        <tr>

            <td> <p>Soyadınız :</p><input type="text" name="kullaniciSoyad" ></td>
        </tr>
        <tr>

            <td> <p>Nick :</p>
                <input type="text" name="nick" ></td>
        </tr>
        <tr>

            <td> <p>Parola :</p>
                <input type="password" name="password">

            </td>

        <tr>

            <td>   </p>E-Mail: </p>
                <input type="email" name="email" id="email"></td>
        </tr>

        <tr>
            <td><input type="submit" name="uyeOl"  value="Üye Ol"></td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
</form>
</div>
</div>
<?php
include "footer.php";
?>
</body>
</html>
