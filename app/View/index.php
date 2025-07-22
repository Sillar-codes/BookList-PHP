<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        header('Location: /signin');
        exit();
    }
?>

<div class="container py-5">
    <h1 class="text-center fw-bold display-4"><?= $model["title"] ?? "" ?></h1>

    <div class="container py-3">
        <div class="row text-center">
            <div class="col-12 pb-5">
                <?php if (isset($_SESSION['user'])): ?>
                    <a type="button" class="btn btn-outline-success" href="/add">Add New Booklist</a>
                    <a type="button" class="btn btn-outline-danger" href="/logout">Logout</a>
                <?php else: ?>
                    <a type="button" class="btn btn-outline-success" href="/signin">Sign In</a>
                    <a type="button" class="btn btn-outline-success" href="/signup">Sign Up</a>
                <?php endif; ?>
            </div>
            <?php if (isset($model['booklist'])) {
                foreach ($model['booklist'] as $row) { ?>
                    <div class="col-12 p-1 p-xl-2">
                        <div class="card mb-1">
                            <div class="card-body">
                                <?= $row['book'] ?>.
                                <a href="/delete?id=<?= $row['id'] ?>" class="text-danger text-decoration-none">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>