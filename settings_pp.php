<?php session_start(); ?>
<?php $Title='Settings'?>

<?php include 'head.php';?>

<body>

<?php
include "connection.php";

if(isset($_SESSION["UserID"]))
{
    $target_dir = "pp/";
    $imageFileType = pathinfo( basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
    $target_file = $target_dir . md5(time()) .".". $imageFileType;
// Check if image file is a actual image or fake image
    if(isset($_POST["savepp"]))
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false)
        {
            if (!file_exists($target_file))
            {
                if ($_FILES["fileToUpload"]["size"] <= 2000000)
                {
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" )
                    {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
                        {
                            $sql="UPDATE Users SET PPURL='".$target_file."' Where UserID=" . $_SESSION["UserID"];
                            if ($result = $conn->query($sql))
                            {
                                if($_SESSION["PPURL"]=="pp/def.jpg")
                                {
                                    $_SESSION["PPURL"]=$target_file;
                                }
                                else
                                {
                                    unlink($_SESSION["PPURL"]);
                                    $_SESSION["PPURL"]=$target_file;
                                }

                                ?>
                                <div class="alert alert-success" role="alert">
                                    Profile Picture Changed Successfuly!
                                </div>
                                <?php
                                header("refresh:2; url=settings_pp.php");
                                exit();
                            }
                            else{
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                                </div>
                                <?php
                                header("refresh:2; url=settings_pp.php");
                                exit();
                            }

                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Sorry, there was an error uploading your file! Try again in a few minutes.
                            </div>
                            <?php
                            header("refresh:3; url=settings_pp.php");
                            exit();
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Sorry, only JPG, JPEG, PNG & GIF files are allowed!
                        </div>
                        <?php
                        header("refresh:2; url=settings_pp.php");
                        exit();
                    }
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Sorry, your file is too large!
                    </div>
                    <?php
                    header("refresh:2; url=settings_pp.php");
                    exit();
                }
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    You should be so unlucky to see this error. your file name is already exist but i am hashing the filenames.<br/>
                    Try to change your filename!
                </div>
                <?php
                header("refresh:2; url=settings_pp.php");
                exit();
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                File is not an image!
            </div>
            <?php
            header("refresh:2; url=settings_pp.php");
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
    <?php $CurrentPage='PP Settings';?>
    <?php include 'navbar.php';?>

    <div class="list-group" style="width: 25%; margin-top: 5%; float: left;">
        <a href="settings_account.php" class="list-group-item">Account</a>
        <a href="settings_password.php" class="list-group-item">Password</a>
        <a href="settings_pp.php" class="list-group-item active">Profile Picture</a>
    </div>

    <div class="" style="width: 70%; margin-top: 5%; float:right;">
        <form action="settings_pp.php" enctype="multipart/form-data" class="form-inline" style="margin-left: 5%; padding-top: 5px" method="post">
            <h1>Profile Picture</h1>
            <br/>

            <div class="form-group" >
                <img src="<?php echo $_SESSION["PPURL"] ?>" class="img-rounded" style="display: inline" alt="<?php echo $_SESSION["Nick"] ?>" width="100" height="100">
            </div>

            <div class="form-group" style="margin-left: 20px">
                <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .gif, .png" required>
                <small style="color:#999">JPG, GIF or PNG, Max size: 2MB</small>
            </div>
            <br/>
            <br/>
            <div class="form-signin" style="margin-left: 0px; max-width: 300px; padding: 15px 0px;">
                <button class="btn btn-lg btn-primary btn-block" name="savepp" style="margin-top: 5px" type="submit">Save Changes</button>
            </div>

        </form>

    </div>

    <?php include 'jscript.php';?>
</div> <!-- /container -->

</body>

<?php include 'foot.php';?>
