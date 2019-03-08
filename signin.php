<?php $Title='Sign in'?>

<?php include 'head.php';?>

<body>

<div class="container">
    <?php $CurrentPage='Sign in';?>
    <?php include 'navbar.php';?>

    <form action="sign_validation.php" class="form-signin" method="post">
        <h2 class="form-signin-heading">Please Sign In</h2>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" style="margin-bottom: 5px" placeholder="Email address" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" name="signin" style="margin-top: 5px" type="submit">Sign in</button>
    </form>

    <?php include 'jscript.php';?>
</div> <!-- /container -->

</body>

<?php include 'foot.php';?>
