<?php
    /*
     * Head
     */
    $title = "Register";
    require 'partial/head.php';
?>

<body>
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
    <div>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName"
               value="<?php echo $old->firstName; ?>">
        <?php
            $field = 'firstName';
            require 'partial/field_error.php';
        ?>
    </div>

    <div>
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName"
               value="<?php echo $old->lastName; ?>">
        <?php
            $field = 'lastName';
            require 'partial/field_error.php';
        ?>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email"
               value="<?php echo $old->email; ?>">
        <?php
            $field = 'email';
            require 'partial/field_error.php';
        ?>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <?php
            $field = 'password';
            require 'partial/field_error.php';
        ?>
    </div>

    <div>
        <label for="passwordConfirm">Password Confirm</label>
        <input type="password" id="passwordConfirm" name="password_confirmation">
    </div>

    <input type="submit" value="Submit">
</form>

<?php
    /*
     * Clear Session
     */
    unset($_SESSION['old_user']);
    unset($_SESSION['errors']);
?>

</body>

<?php
    /*
     * Footer
     */
    require 'partial/footer.php';
?>
