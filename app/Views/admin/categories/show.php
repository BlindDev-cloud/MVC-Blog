<?php Core\View::render('layout/header'); ?>

<div class="container"
     style="color: #000000;">
    <div class="row d-flex justify-content-center">
        <div class="col col-10 text-center">
            <?php if (!empty($category)): ?>
                <div class="card w-100">
                    <h5 class="card-title">
                        <?= $category->title ?>
                    </h5>
                    <img class="card-img-top"
                         src="<?= STORAGE_URL . '/' . $category->image ?>"
                         alt="">
                    <div class="card-body">
                        <p>
                            <?= $category->description ?>
                        </p>
                    </div>
                </div>
            <?php else: ?>
                <h1>
                    Not
                    found</h1>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php Core\View::render('layout/footer'); ?>
