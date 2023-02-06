<?php Core\View::render('layout/header'); ?>
    <div class="container">
        <div class="row">
            <?php if (!empty($posts)): ?>
                <?php require_once VIEW_DIR . '/account/posts/parts/cards.php' ?>
            <?php else: ?>
                <h3 class="text-center text-uppercase">
                    You
                    haven't
                    posted
                    anything</h3>'
            <?php endif; ?>
        </div>
    </div>
<?php Core\View::render('layout/footer'); ?>