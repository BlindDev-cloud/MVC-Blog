<?php Core\View::render('layout/header'); ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center text-uppercase">
            <?php if (!empty($posts)): ?>
                <?php require_once VIEW_DIR . '/admin/posts/parts/list.php'; ?>
            <?php else: ?>
                <?= '<h3>There are no posts yet</h3>'; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php Core\View::render('layout/footer'); ?>
