<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Resim Blog Iletisim</title>
    <meta charset="utf-8"/>


</head>
<body>
<?php
session_start();
include "header.php";
if (@$_POST['iletisimBTN']) {

    if(mail("furkan.tazegll@gmail.com",$_POST['konu'],$_POST['mail'].$_POST['mesajIcerik'])){
        echo '<h1>Başarıyla Gönderildi!</h1>';
        header("refresh:3; url=index.php");
    }
    else{
        echo '<h1>Başarısız!</h1>';
        header("refresh:3; url=index.php");
    }

} else {
    echo '
<div class="anadiv">
    <div class="icerik" style="display: block">
        <form method="post">
        <table width="100%">
            <th align="center" colspan="2">İletişim Formu</th>
            <tr><td>Mail: </td><td><input type="text" name="mail"></td></tr>
            <tr><td>Konu: </td><td><input type="text" name="konu"></td></tr>
            <tr><td>Mesajınız: </td><td><textarea name="mesajIcerik" ></textarea></td></tr>
            <tr><td align="center" colspan="2"><input type="submit" name="iletisimBTN" class="btn"></td></tr>
        </table>
        </form>
    </div>
</div>


    ';
}


?>
</body>
</html>