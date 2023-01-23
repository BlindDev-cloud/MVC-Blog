<?php \Core\View::render('layout/header', ['title' => 'Home']); ?>

    <div class="row justify-content-center">
        <div class="col">
            <h1 class="text-center">
                Home
                page
            </h1>
        </div>
    </div>

<?php if (\App\Helpers\SessionHelper::isLoggedIn()): ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-12 text-center mt-3">
                <?php if(\App\Helpers\SessionHelper::isAdmin()): ?>
                    <h1>WELCOME ADMIN</h1>
                <?php else: ?>
                    <h1>WELCOME USER</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif ?>

<?php \Core\View::render('layout/footer'); ?>