<?php
/*
 * Head
 */
$title = "Edit User";
require __DIR__ . '/../partial/head.php';
?>

<body>
<div class="container">
    <!-- Header / Navigation Bar -->
    <?php require __DIR__ . '/../partial/navbar.php'; ?>

    <h1>Edit User</h1>
    <hr>

    <?php
    /*
     * Get old user posted
     */
    if(isset($_SESSION['old_user'])) {
        $user = unserialize($_SESSION['old_user']);
    }
    ?>

    <?php require __DIR__ . '/../partial/page_error.php'; ?>

    <h2>Update User Info</h2>

    <form action="<?php echo route('admin/user/update'); ?>" method="post">
        <input name="id" type="hidden" value="<?php echo $user->id; ?>">
        
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName"
                       class="form-control <?php echo field_has_error("firstName") ? "is-invalid": ''; ?>"
                       value="<?php echo $user->firstName; ?>">
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
                       value="<?php echo $user->lastName; ?>">
                <?php
                $field = 'lastName';
                require __DIR__ . '/../partial/field_error.php';
                ?>
            </div>
        </div>

        <input class="btn btn-primary mb-2" type="submit" value="Submit">
    </form>

</div>

<?php
/*
 * Clear Session
 */
unset($_SESSION['old_user']);
clear_form_errors();
?>

<?php require __DIR__ . '/../partial/footer.php'; ?>

</body>
</html>