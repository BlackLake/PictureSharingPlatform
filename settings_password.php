<?php session_start(); ?>
<?php $Title='Settings'?>

<?php include 'head.php';?>

<body>

<?php
include "connection.php";

if(isset($_SESSION["UserID"]))
{
    if (isset($_POST['savepassword']))
    {
        if ($_POST['inputOldPassword']==$_SESSION["Password"])
        {
            $sql="UPDATE Users SET Password='".$_POST["inputNewPassword"]."' Where UserID=" . $_SESSION["UserID"];
            if ($result = $conn->query($sql))
            {
                $_SESSION["Password"]=$_POST["inputNewPassword"];

                ?>
                <div class="alert alert-success" role="alert">
                    Password Saved Successfuly!
                </div>
                <?php
                header("refresh:2; url=settings_password.php");
                exit();
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                </div>
                <?php
                header("refresh:2; url=settings_password.php");
                exit();
            }
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
                Old Password Is Not Correct!
            </div>
            <?php
            header("refresh:2; url=settings_password.php");
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
    <?php $CurrentPage='Password Settings';?>
    <?php include 'navbar.php';?>

    <div class="list-group" style="width: 25%; margin-top: 5%; float: left;">
        <a href="settings_account.php" class="list-group-item">Account</a>
        <a href="settings_password.php" class="list-group-item active">Password</a>
        <a href="settings_pp.php" class="list-group-item">Profile Picture</a>
    </div>

    <div class="" style="width: 70%; margin-top: 5%; float: right;">
        <form action="settings_password.php" class="form-signin" style="margin-left: 5%; padding-top: 5px" method="post">
            <h1>Password</h1>
            <br/>

            <h4>Old Password</h4>
            <div class="input-group">
                <label for="inputOldPassword" class="sr-only">Old Password</label>
                <input type="password" id="inputOldPassword" name="inputOldPassword" class="form-control" placeholder="Old Password"
                       required>
                <span id="oldeye" class="input-group-addon glyphicon glyphicon-eye-open"></span>
            </div>
            <br/>

            <h4>New Password</h4>
            <div class="input-group">
                <label for="inputNewPassword" class="sr-only">New Password</label>
                <input type="password" id="inputNewPassword" name="inputNewPassword" class="form-control" placeholder="New Password"
                       required>
                <span id="neweye" class="input-group-addon glyphicon glyphicon-eye-open"></span>
            </div>
            <br/>

            <button class="btn btn-lg btn-primary btn-block" name="savepassword" style="margin-top: 5px" type="submit">Save Changes</button>
        </form>

        <script>
            $("#oldeye").click(function () {
                if ($("#inputOldPassword").attr("type") == "password") {
                    $("#inputOldPassword").attr("type", "text");
                } else {
                    $("#inputOldPassword").attr("type", "password");
                }
            });
            $("#neweye").click(function () {
                if ($("#inputNewPassword").attr("type") == "password") {
                    $("#inputNewPassword").attr("type", "text");
                } else {
                    $("#inputNewPassword").attr("type", "password");
                }
            });
        </script>

    </div>

    <?php include 'jscript.php';?>
</div> <!-- /container -->

</body>

<?php include 'foot.php';?>
