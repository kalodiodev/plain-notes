<?php if(! empty($_SESSION['errors'][$field]) && (sizeof($_SESSION['errors'][$field])) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['errors'][$field] as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>