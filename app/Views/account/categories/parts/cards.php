<?php foreach ($categories as $category): ?>

    <div class="col w-50 my-3 mx-2">
        <a href="<?= url('account/posts/by_category?id=' . $category->id) ?>"
           class="btn">
            <div class="card">
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
        </a>
    </div>

<?php endforeach; ?>