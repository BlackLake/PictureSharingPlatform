<?php session_start(); ?>

<?php $Title='Settings'?>

<?php include 'head.php';?>

<body>

<?php
include "connection.php";

if(isset($_SESSION["UserID"]))
{
    if (isset($_POST['saveaccount']))
    {
        $sql="UPDATE Users SET Nick='".$_POST["inputNick"]."',Email='".$_POST["inputEmail"]."' Where UserID=" . $_SESSION["UserID"];
        if ($result = $conn->query($sql))
        {
            $_SESSION["Email"]=$_POST["inputEmail"];
            $_SESSION["Nick"]=$_POST["inputNick"];

            ?>
            <div class="alert alert-success" role="alert">
                Changes Saved Successfuly!
            </div>
            <?php
            header("refresh:2; url=settings_account.php");
            exit();
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
            </div>
            <?php
            header("refresh:2; url=settings_account.php");
            exit();
        }
    }
}else {
    ?>
    <div class="alert alert-warning" role="alert">
        You Are Not Logged In!
    </div>
    <?php
    header("refresh:2; url=hot.php");
    exit();
}
?>

<div class="container">
    <?php $CurrentPage='Account Settings';?>
    <?php include 'navbar.php';?>

    <div class="list-group" style="width: 25%; margin-top: 5%; float: left;">
        <a href="settings_account.php" class="list-group-item active">Account</a>
        <a href="settings_password.php" class="list-group-item">Password</a>
        <a href="settings_pp.php" class="list-group-item">Profile Picture</a>
    </div>

    <div class="" style="width: 70%; margin-top: 5%; float: right;">
        <form action="settings_account.php" class="form-signin" style="margin-left: 5%; padding-top: 5px" method="post">
            <h1>Account</h1>
            <br/>

            <h4>NickName</h4>
            <label for="inputNick" class="sr-only">NickName</label>
            <input type="text" id="inputNick" name="inputNick" class="form-control" style="margin-bottom: 5px"
                   placeholder="NickName" value="<?php echo $_SESSION["Nick"] ?>" required>
            <br/>

            <h4>Email address</h4>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="inputEmail" class="form-control" style="margin-bottom: 5px"
                   placeholder="Email address" value="<?php echo $_SESSION["Email"] ?>" required>
            <br/>

            <button class="btn btn-lg btn-primary btn-block" name="saveaccount" type="submit">Save Changes</button>
        </form>

    </div>

    <?php include 'jscript.php';?>
</div> <!-- /container -->

</body>

<?php include 'foot.php';?>
