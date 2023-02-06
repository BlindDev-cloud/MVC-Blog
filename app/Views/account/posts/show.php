<?php Core\View::render('layout/header'); ?>

    <div class="container"
         style="color: #000000;">
        <div class="row justify-content-center">
            <div class="col col-10 d-flex align-items-center">

                <?php if (!empty($post)): ?>
                    <div class="card w-100 my-5">
                        <div class="card-header">
                            <div class="row space-between text-center">
                                <div class="col">
                                    Category: <?= $postCategory; ?>
                                </div>
                                <div class="col">
                                    Posted
                                    at: <?= $post->created_at; ?>
                                </div>
                            </div>
                        </div>
                        <img class="card-img-top"
                             src="<?= STORAGE_URL . '/' . $post->thumbnail; ?>"
                             alt="">
                        <div class="card-body">
                            <h1 class="text-center"><?= $post->title; ?></h1>
                            <p class="card-text h4"><?= $post->content; ?></p>
                            <?php if (\App\Helpers\SessionHelper::isAuthor($post->author_id)): ?>
                                <div class="row space-between">
                                    <div class="col">
                                        <a href="<?= url('account/posts/edit?id=' . $post->id) ?>"
                                           class="btn btn-lg btn-secondary">Edit</a>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <form
                                                action="<?= url('account/posts/remove') ?>"
                                                method="POST">
                                            <input
                                                    type="hidden"
                                                    name="id"
                                                    class="form-control"
                                                    value="<?= $post->id ?>">
                                            <button type="submit"
                                                    class="btn btn-lg btn-danger">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
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