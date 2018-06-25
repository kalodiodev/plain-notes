<?php
/*
 * Head
 */
$title = "Login";
require 'partial/head.php';
?>

<body>
<div class="container">
    <!-- Header / Navigation Bar -->
    <?php require 'partial/navbar.php'; ?>

    <h1>Login</h1>
    <hr>

    <?php require 'partial/page_error.php'; ?>

    <form action="<?php echo route('login'); ?>" method="post">
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="email">Email</label>
                <input type="text" id="email" name="email"
                       class="form-control <?php echo field_has_error("email") ? "is-invalid": ''; ?>">
                <?php
                $field = 'email';
                require 'partial/field_error.php';
                ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="password">Password</label>
                <input type="password" id="password"
                       class="form-control <?php echo field_has_error("password") ? "is-invalid": ''; ?>"
                       name="password">
                <?php
                $field = 'password';
                require 'partial/field_error.php';
                ?>
            </div>
        </div>

        <div class="text-right">
            <a href="<?php echo route('forgot-password'); ?>">Forgot password?</a>
        </div>

        <input class="btn btn-primary mb-2" type="submit" value="Login">
    </form>
</div>
<?php
/*
 * Footer
 */
require 'partial/footer.php';
?>

<?php
/*
 * Clear Session
 */
clear_form_errors()
?>

</body>

</html>
