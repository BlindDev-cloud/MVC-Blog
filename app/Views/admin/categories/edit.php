<?php Core\View::render('layout/header', ['admin' => true]); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-8 d-flex align-items-center justify-content-center">
            <?php if (!empty($category)): ?>
                <div class="card w-75 mt-5 bg-dark">
                    <h5 class="card-header">
                        Edit
                        "<?= $category->title ?>"
                        category
                    </h5>
                    <div class="card-body">
                        <form action="<?= url('admin/categories/update'); ?>"
                              method="POST"
                              enctype="multipart/form-data">
                            <input type="hidden"
                                   name="id"
                                   class="form-control"
                                   value="<?= $category->id ?>">
                            <div class="mb-3">
                                <label for="title"
                                       class="form-label">Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       placeholder="Category name"
                                       value="<?= $category->title ?>">
                            </div>
                            <div class="mb-3">
                                <label for="description"
                                       class="form-label">Description</label>
                                <textarea
                                        class="form-control"
                                        name="description"
                                        id="description"
                                        rows="5"
                                        placeholder="Description"><?=
                                    $category->description
                                    ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image"
                                       class="form-label">Image
                                    (optional)</label>
                                <input type="file"
                                       name="image"
                                       class="form-control"
                                       id="image">
                            </div>

                            <?php \Core\View::render('alerts'); ?>

                            <button type="submit"
                                    class="btn btn-primary">
                                Submit
                            </button>
                        </form>
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
