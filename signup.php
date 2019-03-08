<?php $Title = 'Sign Up' ?>

<?php include 'head.php'; ?>

<body>

<div class="container">
    <?php $CurrentPage = 'Sign Up'; ?>
    <?php include 'navbar.php'; ?>

    <form action="sign_validation.php" class="form-signin" method="post">
        <h2 class="form-signin-heading">Please Sign Up</h2>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" style="margin-bottom: 5px"
               placeholder="Email address" required autofocus>

        <label for="inputNick" class="sr-only">Nick</label>
        <input type="text" id="inputNick" name="inputNick" class="form-control" style="margin-bottom: 5px"
               placeholder="Nick" required>

        <div class="input-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"
                   required>
            <span id="eye" class="input-group-addon glyphicon glyphicon-eye-open"></span>
        </div>

        <button class="btn btn-lg btn-primary btn-block" name="signup" style="margin-top: 5px" type="submit">Sign in</button>
    </form>

    <script>
        $("#eye").click(function () {
            if ($("#inputPassword").attr("type") == "password") {
                $("#inputPassword").attr("type", "text");
            } else {
                $("#inputPassword").attr("type", "password");
            }
        });
    </script>

    <?php include 'jscript.php'; ?>

</div> <!-- /container -->

</body>

<?php include 'foot.php'; ?>
