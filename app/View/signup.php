<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user'])) {
        header('Location: /');
        exit();
    }
?>

<div class="container py-5">
    <h1 class="text-center fw-bold display-4"><?= $model["title"] ?? "" ?></h1>

    <form class="mt-5" method="post" action="/signup">
        <?php if (isset($model["error"])) { ?>
            <div class="row justify-content-center">
                <div class="alert alert-danger col-6 text-center" role="alert">
                    <?= $model["error"] ?>
                </div>
            </div>
        <?php } ?>

        <div class="row justify-content-center">
            <div class="col-xl-4 col-8 col-md-6 col-lg-5">
                <div class="form-floating mb-3">
                    <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name">
                    <label for="floatingInput">User Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control" id="floatingInput" placeholder="name">
                    <label for="floatingInput">Password</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>
</div>