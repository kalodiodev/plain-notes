<?php
    /*
     * Head
     */
    $title = "Register";
    require 'partial/head.php';
?>

<body>
    <div class="container">
        <!-- Header / Navigation Bar -->
        <?php require 'partial/navbar.php'; ?>

        <h1>Register</h1>
        <hr>

        <?php
        /*
         * Get old user posted
         */
        if(isset($_SESSION['old_user'])) {
            $old = unserialize($_SESSION['old_user']);
        } else {
            $old = new \App\Model\User();
        }
        ?>

        <?php require 'partial/page_error.php'; ?>

        <form action="<?php echo route('register'); ?>" method="post">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName"
                           class="form-control <?php echo field_has_error("firstName") ? "is-invalid": ''; ?>"
                           value="<?php echo $old->firstName; ?>">
                    <?php
                        $field = 'firstName';
                        require 'partial/field_error.php';
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
                        require 'partial/field_error.php';
                    ?>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                           class="form-control <?php echo field_has_error("email") ? "is-invalid": ''; ?>"
                           value="<?php echo $old->email; ?>">
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

            <div class="form-row">
                <div class="col-md-12 mb-3"
                    <label for="passwordConfirm">Password Confirm</label>
                    <input type="password" id="passwordConfirm" class="form-control" name="password_confirmation">
                </div>
            </div>

            <input class="btn btn-primary mb-2" type="submit" value="Submit">
        </form>

        <?php
            /*
             * Clear Session
             */
            unset($_SESSION['old_user']);
            unset($_SESSION['errors']);
        ?>

    </div>

    <?php
    /*
     * Footer
     */
    require 'partial/footer.php';
    ?>

</body>

</html>


