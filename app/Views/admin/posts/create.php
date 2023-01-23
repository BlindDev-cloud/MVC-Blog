<?php Core\View::render('layout/header', ['admin' => true]); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col text-center">
                <img src="<?= IMG_URL . '/under_construction.webp' ?>"
                     alt=""
                     class="img-fluid">
            </div>
        </div>
    </div>
<?php Core\View::render('layout/footer', ['admin' => true]); ?>