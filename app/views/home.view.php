<?php
/*
 * Head
 */
$title = "Welcome - Plain Notes";
require 'partial/head.php';
?>

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <!-- Header / Navigation Bar -->
        <?php require 'partial/navbar.php'; ?>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">Plain Notes</h1>
            <p class="lead">Plain Notes is very simple web application for keeping tasks and notes.</p>
            <p class="lead">
                <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
            </p>
        </main>

        <?php require 'partial/footer.php'; ?>
    </div>
</body>

</html>
