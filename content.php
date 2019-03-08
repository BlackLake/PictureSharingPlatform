<?php

if($CurrentPage =='Hot')
{
    $sql="SELECT DISTINCT Posts.PostID,Posts.UserID,Posts.Title,Posts.Date,Posts.PhotoURL,(SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID) AS Vote FROM Posts LEFT JOIN Vote ON Posts.PostID=Vote.PostID WHERE (SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID)>2 ORDER BY Posts.Date DESC LIMIT 15";
}
if($CurrentPage =='Trending')
{
    $sql="SELECT DISTINCT Posts.PostID,Posts.UserID,Posts.Title,Posts.Date,Posts.PhotoURL,(SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID) AS Vote FROM Posts LEFT JOIN Vote ON Posts.PostID=Vote.PostID WHERE (SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID)>0 ORDER BY Posts.Date DESC LIMIT 15";
}
if($CurrentPage =='Bests')
{
    $sql="SELECT DISTINCT Posts.PostID,Posts.UserID,Posts.Title,Posts.Date,Posts.PhotoURL,(SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID) AS Vote FROM Posts LEFT JOIN Vote ON Posts.PostID=Vote.PostID WHERE (SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID)>0 ORDER BY `Vote` DESC LIMIT 5";
}
if($CurrentPage =='Fresh')
{
    $sql="SELECT DISTINCT Posts.PostID,Posts.UserID,Posts.Title,Posts.Date,Posts.PhotoURL,(SELECT SUM(Value) AS Points FROM Vote WHERE PostID=Posts.PostID) AS Vote FROM Posts LEFT JOIN Vote ON Posts.PostID=Vote.PostID ORDER BY Posts.Date DESC LIMIT 15";
}
if($CurrentPage =='Profile')
{
    if (isset($_GET["userid"]))
    {
        $sql="SELECT DISTINCT Posts.PostID,Posts.UserID,Posts.Title,Posts.Date,Posts.PhotoURL,(SELECT COUNT(Vote.VoteID) FROM Vote WHERE Vote.PostID=Posts.PostID) AS Vote FROM Posts LEFT JOIN Vote ON Posts.PostID=Vote.PostID WHERE Posts.UserID=" . $_GET["userid"] . " ORDER BY Posts.Date DESC LIMIT 15";
    }
    else
    {
        ?>
        <div class="alert alert-warning" role="alert">
            The URL Is Broken
        </div>
        <?php
        header("refresh:2; url=hot.php");
        exit();
    }
}

if ($result = $conn->query($sql))
{
    while ($row = $result->fetch_assoc())
    {
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

        <div class="panel panel-default" id="contentpanel">

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

                        <button class="btn btn-default" type="submit" name="comment" style="margin: 0 10px 0 0; "><span class="glyphicon glyphicon glyphicon-comment"></span></button>
                        <h3 class="panel-title" style="float: right; margin-top: 8px;"><?= $points." Points ".$commentCount." Comments" ?></h3>

                    </form>
                  </span>
                </div>

            </div>

        </div>

        <?php
    }
}else{
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo "Error: " . $sql . "<br>" . $conn->error;?>
    </div>
    <?php
    header("refresh:2; url=hot.php");
    exit();
}

?>

