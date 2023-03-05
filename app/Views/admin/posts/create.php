<?php Core\View::render('layout/header', ['admin' => true]); ?>

<?php
$data = \App\Helpers\SessionHelper::get('data');
$postCategory = \App\Helpers\SessionHelper::get('postCategory');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-8 d-flex align-items-center justify-content-center">
            <div class="card w-75 mt-5 bg-dark">
                <h5 class="card-header">
                    Create
                    new
                    post
                </h5>
                <div class="card-body">
                    <form action="<?= url('admin/posts/store'); ?>"
                          method="POST"
                          enctype="multipart/form-data">
                        <input type="hidden"
                               name="author_id"
                               id="author_id"
                               class="form-control"
                               value="<?= \App\Helpers\SessionHelper::id(); ?>">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary dropdown-toggle"
                                        type="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    Select
                                    Category
                                </button>
                                <div class="dropdown-menu">
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <a class="dropdown-item"
                                               href="<?= url('admin/posts/selectPostCategory?id=' . $category->id . '&title=' . $category->title); ?>">
                                                <?= $category->title; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-2 ml-3">
                                <label class="form-label">
                                    <?= $postCategory['title'] ?? 'Not selected' ?>
                                </label>
                            </div>
                            <input type="hidden"
                                   name="category_id"
                                   class="form-control"
                                   value="<?= $postCategory['id'] ?? null; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="title"
                                   class="form-label">Title</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   id="title"
                                   placeholder="Title"
                                   value="<?= $data['title'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content"
                                   class="form-label">Content</label>
                            <textarea
                                    class="form-control"
                                    name="content"
                                    id="content"
                                    cols="30"
                                    rows="10"
                                    placeholder="Content"><?=
                                    $data['content'] ?? ''
                                ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail"
                                   class="form-label">Thumbnail</label>
                            <input type="file"
                                   name="thumbnail"
                                   class="form-control"
                                   id="thumbnail">
                        </div>

                        <?php \Core\View::render('alerts'); ?>

                        <button type="submit"
                                class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Core\View::render('layout/footer', ['admin' => true]); ?>
