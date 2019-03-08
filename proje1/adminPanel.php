<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Admin Panel</title>
    <meta charset="utf-8"/>
</head>
<body style="justify-conyent:center">
<?php
session_start();
include "baglanti.php";
include "header.php";

if(@$_SESSION['oturum']==true && @$_SESSION['yetki']==1){

    echo '
    <div style="padding:10px;margin:0 auto;width:95%;padding-left:30px;">
	<div class="admin">';

    echo '</div>
    <div class="admin">';

    echo '</div>
	<div class="admin">';

    echo '</div>
	<div class="admin">';

    echo '</div>
</div>
    ';
}
else{
    echo '<center><h1>Yetkiniz Yok!</h1></center>';
}


?>
</body>
</html>
