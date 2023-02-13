<?php foreach ($posts as $post): ?>

    <div class="my-3 mx-2">
        <a href="<?= url('account/posts/show?id=' . $post->id) ?>"
           class="btn">
            <div class="card">
                <img class="card-img-top"
                     src="<?= STORAGE_URL . '/' . $post->thumbnail ?>"
                     alt="">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $post->title ?>
                    </h5>
                </div>
            </div>
        </a>
    </div>

<?php endforeach; ?>