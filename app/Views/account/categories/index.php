<?php Core\View::render('layout/header'); ?>
    <div class="container">
        <div class="row">
            <?php if (!empty($categories)): ?>
                <?php require_once VIEW_DIR . '/account/categories/parts/cards.php' ?>
            <?php else: ?>
                <h3 class="text-center text-uppercase">
                    There are no categories yet
                </h3>
            <?php endif; ?>
        </div>
    </div>
<?php Core\View::render('layout/footer'); ?>