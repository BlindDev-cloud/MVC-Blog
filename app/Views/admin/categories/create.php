<?php Core\View::render('layout/header', ['admin' => true]); ?>

<?php
$data = \App\Helpers\SessionHelper::get('data');
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-8 d-flex align-items-center justify-content-center">
                <div class="card w-75 mt-5 bg-dark">
                    <h5 class="card-header">
                        Create
                        new
                        category
                    </h5>
                    <div class="card-body">
                        <form action="<?= url('admin/categories/store'); ?>"
                              method="POST"
                              enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title"
                                       class="form-label">Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       placeholder="Category name"
                                       value="<?= $data['title'] ?? '' ?>">
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
                                        $data['description'] ?? ''
                                    ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image"
                                       class="form-label">Image</label>
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
            </div>
        </div>
    </div>
<?php Core\View::render('layout/footer'); ?>