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