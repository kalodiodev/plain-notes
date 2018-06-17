<?php
/*
 * Head
 */
$title = "Settings";
require __DIR__ . '/../partial/head.php';
?>

<body>
    <div class="container">
        <!-- Header / Navigation Bar -->
        <?php require __DIR__ . '/../partial/navbar.php'; ?>

        <h1>Settings</h1>
        <p>User settings</p>
        <hr>

        <?php
        /*
         * Get old user posted
         */
        if(isset($_SESSION['old_user'])) {
            $old = unserialize($_SESSION['old_user']);
        } else {
            $old = auth();
        }
        ?>

        <?php require __DIR__ . '/../partial/page_error.php'; ?>

        <h2>Update User Info</h2>

        <form action="<?php echo route('user/info_update'); ?>" method="post">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName"
                           class="form-control <?php echo field_has_error("firstName") ? "is-invalid": ''; ?>"
                           value="<?php echo $old->firstName; ?>">
                    <?php
                    $field = 'firstName';
                    require __DIR__ . '/../partial/field_error.php';
                    ?>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName"
                           class="form-control <?php echo field_has_error("lastName") ? "is-invalid": ''; ?>"
                           value="<?php echo $old->lastName; ?>">
                    <?php
                    $field = 'lastName';
                    require __DIR__ . '/../partial/field_error.php';
                    ?>
                </div>
            </div>

            <input class="btn btn-primary mb-2" type="submit" value="Submit">
        </form>

        <hr>

        <h2 style="margin-top: 40px;">Update Password</h2>
        <form action="<?php echo route('user/password_update'); ?>" method="post">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password"
                           class="form-control <?php echo field_has_error("password") ? "is-invalid": ''; ?>"
                           name="password">
                    <?php
                    $field = 'password';
                    require __DIR__ . '/../partial/field_error.php';
                    ?>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="passwordConfirm">Password Confirm</label>
                    <input type="password" id="passwordConfirm" class="form-control" name="password_confirmation">
                </div>
            </div>

            <input class="btn btn-primary mb-2" type="submit" value="Submit">
        </form>

        <hr>

        <h2 style="margin-top: 40px;">Delete Account</h2>
        <form action="<?php echo route('user/delete_account'); ?>" method="post">
            <input class="btn btn-danger mb-2" type="submit" value="Delete" name="delete_account">
        </form>

        <?php
        /*
         * Clear Session
         */
        unset($_SESSION['old_user']);
        clear_form_errors();
        ?>

    </div>

    <?php require __DIR__ . '/../partial/footer.php'; ?>

</body>
</html>