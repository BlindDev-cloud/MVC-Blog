<?php Core\View::render('layout/header'); ?>

<div class="container" style="color: #000000;">
    <div class="row justify-content-center">
        <div class="col col-10 d-flex align-items-center justify-content-center">

            <?php if(!empty($category)): ?>
            <div class="card w-75 mt-5">
                <img class="card-img-top" src="<?= IMG_URL . '/' . $category->image; ?>" alt="">
                <div class="card-body">
                    <h2 class="card-title"><?= $category->title; ?></h2>
                    <p class="card-text h4"><?= $category->description; ?></p>
                    <a href="<?= url('admin/categories'); ?>" class="btn btn-lg btn-primary mt-2">Back</a>
                </div>
            </div>
            <?php else: ?>
                 <h1>Not found</h1>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php Core\View::render('layout/footer'); ?>
