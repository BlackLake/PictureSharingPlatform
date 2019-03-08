<?php session_start(); ?>
<?php $Title='Post';?>

<?php include 'head.php';?>
<body>
<?php $CurrentPage='Post';?>
<?php include 'navbar.php';?>

<?php include "connection.php";?>
<?php
if (isset($_POST['upvote']))
{
    if (isset($_SESSION["UserID"]))
    {
        $sql="SELECT VoteID FROM Vote WHERE Value='1' AND PostID=".$_GET["postid"]." AND UserID=".$_SESSION["UserID"];
        if ($result = $conn->query($sql))
        {
            if ($result->num_rows > 0)
            {
                $sql="Delete FROM Vote WHERE Value='1' AND PostID=".$_GET["postid"]." AND UserID=".$_SESSION["UserID"];
            }
            else
            {
                $sql="INSERT INTO Vote(UserID,PostID,Value) VALUES(".$_SESSION["UserID"].",".$_GET["postid"].",'1')";
            }
            if ($result = $conn->query($sql))
            {
                $sql="Delete FROM Vote WHERE Value='-1' AND PostID=".$_GET["postid"]." AND UserID=".$_SESSION["UserID"];
                if ($result = $conn->query($sql))
                {

                }
                else
                {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                    </div>
                    <?php
                    header("refresh:2; url=post.php?postid=".$_GET["postid"]);
                    exit();
                }
            }
            else
            {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                </div>
                <?php
                header("refresh:112; url=post.php?postid=".$_GET["postid"]);
                exit();
            }
        }
        else
        {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
            </div>
            <?php
            header("refresh:112; url=post.php?postid=".$_GET["postid"]);
            exit();
        }
    }else {
        ?>
        <div class="alert alert-warning" role="alert">
            You Are Not Logged In!
        </div>
        <?php
        header("refresh:112; url=post.php?postid=".$_GET["postid"]);
        exit();
    }

}
if (isset($_POST['downvote']))
{
    if (isset($_SESSION["UserID"]))
    {
        $sql="SELECT VoteID FROM Vote WHERE Value='-1' AND PostID=".$_GET["postid"]." AND UserID=".$_SESSION["UserID"];
        if ($result = $conn->query($sql))
        {
            if ($result->num_rows > 0)
            {
                $sql="Delete FROM Vote WHERE Value='-1' AND PostID=".$_GET["postid"]." AND UserID=".$_SESSION["UserID"];
            }
            else
            {
                $sql="INSERT INTO Vote(UserID,PostID,Value) VALUES(".$_SESSION["UserID"].",".$_GET["postid"].",'-1')";
            }
            if ($result = $conn->query($sql))
            {
                $sql="Delete FROM Vote WHERE Value='1' AND PostID=".$_GET["postid"]." AND UserID=".$_SESSION["UserID"];
                if ($result = $conn->query($sql))
                {

                }
                else
                {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                    </div>
                    <?php
                    header("refresh:2; url=post.php?postid=".$_GET["postid"]);
                    exit();
                }
            }
            else
            {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                </div>
                <?php
                header("refresh:2; url=post.php?postid=".$_GET["postid"]);
                exit();
            }
        }
        else
        {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
            </div>
            <?php
            header("refresh:2; url=post.php?postid=".$_GET["postid"]);
            exit();
        }
    }else {
        ?>
        <div class="alert alert-warning" role="alert">
            You Are Not Logged In!
        </div>
        <?php
        header("refresh:2; url=post.php?postid=".$_GET["postid"]);
        exit();
    }
}
if (isset($_POST['comment']) && isset($_POST["inputComment"]))
{
    if (isset($_SESSION["UserID"]))
    {
        $sql="INSERT INTO Comments(UserID,PostID,Comment) VALUES(".$_SESSION["UserID"].",".$_GET["postid"].",'".$_POST["inputComment"]."')";
        if ($result = $conn->query($sql))
        {

        }
        else
        {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
            </div>
            <?php
            header("refresh:2; url=post.php?postid=".$_GET["postid"]);
            exit();
        }
    }else {
        ?>
        <div class="alert alert-warning" role="alert">
            You Are Not Logged In!
        </div>
        <?php
        header("refresh:2; url=post.php?postid=".$_GET["postid"]);
        exit();
    }
}
if (isset($_GET['postid']))
{
    $sql="SELECT PostID, UserID, Title, Date, PhotoURL FROM Posts WHERE PostID=".$_GET["postid"];
    if ($result = $conn->query($sql))
    {
        $row=$result->fetch_array();
        $sqlPost="SELECT VoteID FROM Vote WHERE Value='1' AND PostID=".$row['PostID']." AND UserID=".$_SESSION["UserID"];
        if ($resultPost = $conn->query($sqlPost)) {
            ($resultPost->num_rows > 0)?$up=true:$up=false;
        }
        $sqlPost="SELECT VoteID FROM Vote WHERE Value='-1' AND PostID=".$row['PostID']." AND UserID=".$_SESSION["UserID"];
        if ($resultPost = $conn->query($sqlPost)) {
            ($resultPost->num_rows > 0)?$down=true:$down=false;
        }


        $sqlVote="SELECT SUM(Value) AS Points FROM Vote WHERE PostID=".$row['PostID'];
        if ($resultVote = $conn->query($sqlVote)) {
            $points=$resultVote->fetch_assoc()["Points"];
            if ($points==null)$points=0;
        }

        $sqlComment="SELECT COUNT(CommentID) AS CommentCount FROM Comments WHERE PostID=".$row['PostID'];
        if ($resultComment = $conn->query($sqlComment)) {
            $commentCount=$resultComment->fetch_assoc()["CommentCount"];
        }
        ?>
        <script>document.title = "<?php echo $row["Title"] ?>";</script>
        <div class="panel panel-default" id="postpanel">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $row["Title"] ?></h3>
            </div>

            <div class="panel-body">
                <img src="<?php echo $row["PhotoURL"] ?>" class="img-responsive" style="max-width: 100%; margin: 0 auto;" alt="<?php echo $row["Title"] ?>" >
            </div>

            <div class="panel-footer" style="padding: 5px 5px 5px 15px;">

                <div class="input-group">
                  <span class="input-group-btn">
                      <form action="post.php?postid=<?php echo $row['PostID'];?>" style="display: inline;" method="post">

                          <button class="btn btn-default" type="submit" name="upvote" style="margin: 0 10px 0 0;color:<?=($up)?'blue':'';?>"><span class="glyphicon glyphicon-arrow-up"></span></button>
                          <button class="btn btn-default" type="submit" name="downvote" style="margin: 0 10px 0 0;color:<?=($down)?'blue':'';?>"><span class="glyphicon glyphicon-arrow-down"></span></button>

                          <h3 class="panel-title" style="float: right; margin-top: 8px;"><?= $points." Points ".$commentCount." Comments" ?></h3>

                      </form>

                  </span>
                </div>
            </div>
        </div>

        <br/>

        <div class="panel panel-default" id="postpanel" style="padding: 0px; overflow:hidden">

            <form action="post.php?postid=<?php echo $row['PostID'];?>" class="form-signin" style="margin: 0px; padding: 0px; max-width: none;" method="post">

                <input type="text" id="inputComment" name="inputComment" class="form-control" style="height: 70px; width: 100%;"
                       placeholder="Write comment..." required>
                <button name="comment" style="float: right" type="submit">Post</button>

            </form>

        </div>

        <?php
        $sql = "SELECT Comments.CommentID, Comments.UserID, Comments.PostID, Comments.Comment, Comments.Date FROM Comments INNER JOIN Posts ON Posts.PostID=Comments.PostID WHERE Posts.PostID=" . $_GET['postid']." ORDER BY Comments.Date DESC";
        if ($result = $conn->query($sql))
        {
            while ($row = $result->fetch_assoc())
            {
                $sqlUser="SELECT Nick, PPURL FROM Users WHERE UserID=".$row["UserID"];
                if ($resultUser = $conn->query($sqlUser))
                {
                    $rowUser=$resultUser->fetch_array();
                    ?>
                    <br/>
                    <div class="panel panel-default" id="postpanel">

                        <div class="panel-heading" style="padding: 3px">
                            <p style="margin: 0px;">
                                <img src="<?php echo $rowUser["PPURL"] ?>" class="img-rounded" style=" width: 40px; height: 40px;" alt="<?php echo $rowUser["Nick"] ?>">
                            <?php echo $rowUser["Nick"] ?>
                            </p>

                        </div>
                        <div class="panel-body" style="padding: 10px">
                            <?php echo $row["Comment"] ?>
                        </div>

                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
                    </div>
                    <?php
                    header("refresh:112; url=hot.php");
                    exit();
                }
            }

        }
        else
        {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
            </div>
            <?php
            header("refresh:112; url=hot.php");
            exit();
        }
    }
    else
    {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
        </div>
        <?php
        header("refresh:2; url=hot.php");
        exit();
    }
}
else
{
    ?>
    <div class="alert alert-danger" role="alert">
        There Is A Problem!
    </div>
    <?php
    header("refresh:2; url=hot.php");
    exit();
}

?>

<?php include 'jscript.php';?>
</body>
<?php include 'foot.php';?>
