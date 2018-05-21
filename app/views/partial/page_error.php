<?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?php echo get_error_message(); ?>
    </div>
<?php endif; ?>