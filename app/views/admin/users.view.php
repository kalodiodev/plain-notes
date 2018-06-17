<?php
/*
 * Head
 */
$title = "Users";
require __DIR__ . '/../partial/head.php';
?>

<body>
<div class="container">
    <!-- Header / Navigation Bar -->
    <?php require __DIR__ . '/../partial/navbar.php'; ?>

    <h1>Users</h1>
    <hr>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->firstName; ?></td>
                <td><?php echo $user->lastName; ?></td>
                <td><?php echo $user->email; ?></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="/admin/user/edit?id=<?php echo $user->id; ?>">Edit</a>
                    <a class="btn btn-danger btn-sm" href="/admin/user/delete?id=<?php echo $user->id; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/../partial/pagination.php'; ?>

<?php require __DIR__ . '/../partial/footer.php'; ?>

</body>
</html>