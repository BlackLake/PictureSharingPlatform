<?php session_start(); ?>

<?php include 'head.php';?>
<body>
<?php
if (isset($_SESSION["UserID"]))
{
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();

    ?>
    <div class="alert alert-success" role="alert">
        You Have Successfully Logged out!
    </div>
    <?php
    header("refresh:2; url=hot.php");
    exit();
}
else
{
    ?>
    <div class="alert alert-warning" role="alert">
        You Are Not Logged In!
    </div>
    <?php
    header("refresh:2; url=hot.php");
    exit();
}
?>
</body>
<?php include 'foot.php';?>
