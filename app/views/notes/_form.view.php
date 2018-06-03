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