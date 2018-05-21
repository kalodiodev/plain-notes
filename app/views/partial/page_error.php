<?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?php
        echo $_SESSION['error_message'];
        unset($_SESSION['error_message']);
        ?>
    </div>
<?php endif; ?>