
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="<?php if($CurrentPage =='Hot'){echo 'active';}?>"><a href="hot.php">Hot</a></li>
                <li class="<?php if($CurrentPage =='Trending'){echo 'active';}?>"><a href="trending.php">Trending</a></li>
                <li class="<?php if($CurrentPage =='Bests'){echo 'active';}?>"><a href="bests.php">Bests</a></li>
                <li class="<?php if($CurrentPage =='Fresh'){echo 'active';}?>"><a href="fresh.php">Fresh</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right" >
                <?php
                if (isset($_SESSION["UserID"]))
                {
                ?>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" style="padding: 7px 7px 7px 7px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $_SESSION["PPURL"] ?>" class="img-rounded" alt="<?php echo $_SESSION["Nick"] ?>" width="36" height="36"></a>
                        <ul class="dropdown-menu" >
                            <li><a href="profile.php?userid=<?php echo $_SESSION["UserID"] ?>">My Profile</a></li>
                            <li><a href="settings_account.php">Settings</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <li class=""><a href="upload.php"><span class="glyphicon glyphicon-plus"></span></span> Upload</a></li>

                <?php
                }
                else
                {
                ?>
                    <li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <?php
                }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
