<?php session_start(); ?>
<?php $Title='Upload';?>

<?php include 'head.php';?>

<body>

<?php
include "connection.php";

if(isset($_SESSION["UserID"]))
{
    $target_dir = "posts/";
    $imageFileType = pathinfo( basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
    $target_file = $target_dir . md5(time()) .".". $imageFileType;
// Check if image file is a actual image or fake image
    if(isset($_POST["uploadpost"]))
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
                            $sql="INSERT INTO Posts(UserID,Title,PhotoURL) VALUES('".$_SESSION["UserID"]."','".$_POST["inputTitle"]."','".$target_file."')";
                            if ($result = $conn->query($sql))
                            {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    Image Posted Successfuly!
                                </div>
                                <?php
                                header("refresh:2; url=fresh.php");
                                exit();
                            }
                            else{
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                                </div>
                                <?php
                                header("refresh:2; url=upload.php");
                                exit();
                            }

                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Sorry, there was an error uploading your file! Try again in a few minutes.
                            </div>
                            <?php
                            header("refresh:3; url=upload.php");
                            exit();
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Sorry, only JPG, JPEG, PNG & GIF files are allowed!
                        </div>
                        <?php
                        header("refresh:2; url=upload.php");
                        exit();
                    }
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Sorry, your file is too large!
                    </div>
                    <?php
                    header("refresh:2; url=upload.php");
                    exit();
                }
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    You should be so unlucky to see this error. your file name is already exist but i am hashing the filenames.<br/>
                    Try to change your filename!
                </div>
                <?php
                header("refresh:2; url=upload.php");
                exit();
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                File is not an image!
            </div>
            <?php
            header("refresh:2; url=upload.php");
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
    <?php $CurrentPage='Upload';?>
    <?php include 'navbar.php';?>

    <div class="" style="width: 70%; margin-top: 5%; float:right;">
        <form action="upload.php" enctype="multipart/form-data" class="form-inline" style="margin-left: 5%; padding-top: 5px" method="post">
            <h1>Upload Post</h1>
            <br/>

            <div class="form-signin" style="margin: 0px; padding: 0px;">
                <h4>Title</h4>
                <label for="inputTitle" class="sr-only">Title</label>
                <input type="text" id="inputTitle" name="inputTitle" class="form-control" style="margin-bottom: 5px"
                       placeholder="Title" required>
                <br/>
                <br/>
            </div>

            <div class="form-group"">
                <span class="glyphicon glyphicon-upload" style="font-size: 75px; float: left;"></span>
                <div style="float: left; margin-left: 10px; margin-top: 17px;">
                    <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .gif, .png" required>
                    <small style="color:#999;">JPG, GIF or PNG, Max size: 2MB</small>
                </div>
            </div>
            <br/>
            <br/>
            <div class="form-signin" style="margin-left: 0px; max-width: 300px; padding: 15px 0px;">
                <button class="btn btn-lg btn-primary btn-block" name="uploadpost" style="margin-top: 5px" type="submit">Post</button>
            </div>

        </form>

    </div>

    <?php include 'jscript.php';?>
</div> <!-- /container -->

</body>
<?php include 'foot.php';?>
