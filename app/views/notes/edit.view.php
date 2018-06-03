<?php
/*
 * Head
 */
$title = "Notes";
require __DIR__ . '/../partial/head.php';
?>

<body>
<div class="container">
    <!-- Header / Navigation Bar -->
    <?php require __DIR__ . '/../partial/navbar.php'; ?>

    <h1>Edit Note</h1>
    <hr>

    <?php
    /*
     * Get old note
     */
    if(isset($_SESSION['old_note'])) {
        $old = unserialize($_SESSION['old_note']);
    } else {
        $old = $note;
    }
    ?>

    <?php require __DIR__ . '/../partial/page_error.php'; ?>

    <form method="post" action="<?php echo route('notes/update'); ?>">
        <input type="text" name="id" value="<?php echo $note->id; ?>" hidden>
        
        <?php require __DIR__ . '/../notes/_form.view.php'; ?>

    </form>

</div>

<?php
/*
 * Clear Session
 */
unset($_SESSION['old_note']);
clear_form_errors();
?>

<?php require __DIR__ . '/../partial/footer.php'; ?>

</body>
</html>