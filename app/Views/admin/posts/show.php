<?php Core\View::render('layout/header'); ?>

    <div class="container" style="color: #000000;">
        <div class="row justify-content-center">
            <div class="col col-10 d-flex align-items-center justify-content-center">

                <?php if(!empty($post)): ?>
                    <div class="card w-100 my-5">
                        <img class="card-img-top" src="<?= STORAGE_URL . '/' . $post->thumbnail; ?>" alt="">
                        <div class="card-body">
                            <h1 class="text-center"><?= $post->title; ?></h1>
                            <p class="card-text h4"><?= $post->content; ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <h1>Not found</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php Core\View::render('layout/footer'); ?>