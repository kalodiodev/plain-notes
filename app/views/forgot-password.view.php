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

            <input class="btn btn-primary mb-2" type="submit" value="Reset Password">
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
