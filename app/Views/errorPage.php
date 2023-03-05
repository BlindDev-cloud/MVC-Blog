<?php \Core\View::render('layout/header'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-4 border border-light text-center">
                <h1>
                    <?= $code ?>
                </h1>
                <p>
                    <?= $message ?>
                </p>
            </div>
        </div>
    </div>

<?php \Core\View::render('layout/footer'); ?>
