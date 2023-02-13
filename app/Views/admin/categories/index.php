<?php Core\View::render('layout/header'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-uppercase">
                <?php if (!empty($categories)): ?>
                    <?php require_once VIEW_DIR . '/admin/categories/parts/list.php'; ?>
                <?php else: ?>
                    <?= '<h3>There are no categories yet</h3>'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php Core\View::render('layout/footer'); ?>