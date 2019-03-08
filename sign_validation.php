<?php session_start(); ?>

<?php include 'head.php';?>
    <body>
<?php
    include "connection.php";

    if (isset($_POST['signup'])) {

        $sql = "SELECT * FROM Users where Email = '" . $_POST["inputEmail"] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            ?>
            <div class="alert alert-danger" role="alert">
                <strong>E-mail</strong> Is Already In Use!
            </div>
            <?php
            header("refresh:2; url=signup.php");
            exit();
        } else {
            $sql = "SELECT * FROM Users where Nick = '" . $_POST["inputNick"] . "' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                ?>
                <div class="alert alert-danger" role="alert">
                    <strong>NickName</strong> Is Already In Use!
                </div>
                <?php
                header("refresh:2; url=signup.php");
                exit();
            }
            else
            {
                $sql = "INSERT INTO Users(Email,Nick,Password,PPURL) VALUES('" . $_POST["inputEmail"] . "' , '" . $_POST["inputNick"] . "' , '" . $_POST["inputPassword"] . "' , 'pp/def.jpg' )" ;

                $result = $conn->query($sql);
                if ($result === TRUE)
                {

                    $last_id = $conn->insert_id;
                    $sql = "SELECT * FROM Users where UserID = " . $last_id;
                    if($result = $conn->query($sql))
                    {
                        $row=$result->fetch_array();

                        $_SESSION["UserID"]=$row["UserID"];
                        $_SESSION["Email"]=$row["Email"];
                        $_SESSION["Nick"]=$row["Nick"];
                        $_SESSION["Password"]=$row["Password"];
                        $_SESSION["PPURL"]=$row["PPURL"];
                        ?>
                        <div class="alert alert-success" role="alert">
                            Sign Up Successfull
                        </div>
                        <?php
                        header("refresh:2; url=hot.php");
                        exit();
                    }
                    else{
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                        </div>
                        <?php
                        header("refresh:2; url=signup.php");
                        exit();
                    }

                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                       <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                    </div>
                    <?php
                    header("refresh:2; url=signup.php");
                    exit();

                }
                $conn->close();
            }
        }
    }

    else if(isset($_POST['signin']))
    {
        $sql = "SELECT * FROM Users where Email = '" . $_POST["inputEmail"] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {

            $row=$result->fetch_array();

            if ($row["Password"] == $_POST["inputPassword"])
            {

                $_SESSION["UserID"]=$row["UserID"];
                $_SESSION["Email"]=$row["Email"];
                $_SESSION["Nick"]=$row["Nick"];
                $_SESSION["Password"]=$row["Password"];
                $_SESSION["PPURL"]=$row["PPURL"];

                ?>
                <div class="alert alert-success" role="alert">
                    Log in Successfull
                </div>
                <?php
                header("refresh:1; url=hot.php");
                exit();
            }
            else{
                ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Password</strong> Is Wrong!
                </div>
                <?php
                header("refresh:2; url=signin.php");
                exit();
            }

        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                This <strong>E-mail</strong> Is Not Registered!
            </div>
            <?php
            header("refresh:2; url=signin.php");
            exit();
        }
    }






?>
</body>
<?php include 'foot.php';?>
