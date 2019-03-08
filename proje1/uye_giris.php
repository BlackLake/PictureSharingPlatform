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
            <center><p>GİRİŞ</p></center>
            <table width="100%" border="0">
                <tr>
                    <td> <p>Nick :</p>
                        <input type="text" name="nick" >
                    </td>

                </tr>
                <tr>
                    <td> <p>Parola :</p>
                        <input type="password" name="password">

                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="uyeGiris"  value="Giriş"></td>
                </tr>
                </table>

    </div>
</div>
<?php
include "footer.php";
?>
</body>
</html>
