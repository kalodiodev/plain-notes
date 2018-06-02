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

    <h1>Create Note</h1>
    <hr>

    <?php
    /*
     * Get old note
     */
    if(isset($_SESSION['old_note'])) {
        $old = unserialize($_SESSION['old_note']);
    } else {
        $old = new \App\Model\Note();
    }
    ?>

    <?php require __DIR__ . '/../partial/page_error.php'; ?>

    <form method="post" action="<?php echo route('notes'); ?>">
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="title">Title</label>
                <input type="text" id="title" name="title"
                       class="form-control <?php echo field_has_error("title") ? "is-invalid": ''; ?>"
                       value="<?php echo $old->title; ?>">
                <?php
                $field = 'title';
                require __DIR__ . '/../partial/field_error.php';
                ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="description">Description</label>
                <input type="text" id="description" name="description"
                       class="form-control <?php echo field_has_error("description") ? "is-invalid": ''; ?>"
                       value="<?php echo $old->description; ?>">
                <?php
                $field = 'title';
                require __DIR__ . '/../partial/field_error.php';
                ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="details">Details</label>
                <textarea class="form-control <?php echo field_has_error("details") ? "is-invalid": ''; ?>"
                          name="details"
                ><?php echo $old->details; ?></textarea>
                <?php
                $field = 'details';
                require __DIR__ . '/../partial/field_error.php';
                ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="date">Date</label>
                <input
                    id="date"
                    type="date"
                    name="exp_date"
                    class="form-control <?php echo field_has_error("exp_name") ? "is-invalid": ''; ?>"
                    value="<?php echo $old->exp_date;?>">

                <?php
                $field = 'exp_name';
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
unset($_SESSION['old_note']);
clear_form_errors();
?>

<?php require __DIR__ . '/../partial/footer.php'; ?>

</body>
</html>