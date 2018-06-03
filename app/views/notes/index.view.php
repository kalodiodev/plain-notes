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

        <h1>Notes</h1>
        <hr>

        <!-- Error Messages -->
        <?php require __DIR__ . '/../partial/page_error.php'; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                <tr>
                    <td><?php echo $note->title; ?></td>
                    <td><?php echo $note->description; ?></td>
                    <td><?php echo $note->exp_date; ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="/notes/edit?id=<?php echo $note->id; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="/notes/delete?id=<?php echo $note->id; ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="/notes/create">Add New</a>
    </div>

    <?php require __DIR__ . '/../partial/footer.php'; ?>

    <?php
    /*
     * Clear Session
     */
    clear_form_errors();
    ?>
</body>
</html>
