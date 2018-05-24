<?php if(field_has_error($field)): ?>
    <div class="invalid-feedback">
        <ul>
            <?php foreach ($_SESSION['errors'][$field] as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>