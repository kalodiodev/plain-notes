<?php
/*
 * Head
 */
$title = "Reset Password";
require 'partial/head.php';
?>

<body>
<div class="container">
    <!-- Header / Navigation Bar -->
    <?php require 'partial/navbar.php'; ?>

    <h1>Reset Password</h1>
    <hr>

    <form action="<?php echo route('reset-password'); ?>" method="post">
        < class="form-row">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="token" value="<?php echo $token; ?>">

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

        <div class="form-row">
            <div class="col-md-12 mb-3"
            <label for="passwordConfirm">Password Confirm</label>
            <input type="password" id="passwordConfirm" class="form-control" name="password_confirmation">
        </div>

        <input class="btn btn-primary mb-2" type="submit" value="Submit">
    </form>

    <?php require 'partial/page_error.php'; ?>

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