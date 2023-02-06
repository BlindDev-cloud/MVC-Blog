<?php Core\View::render('layout/header', ['admin' => true]); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-8 d-flex align-items-center justify-content-center">

            <?php if (!empty($post)): ?>
                <div class="card w-75 mt-5 bg-dark">
                    <h5 class="card-header">
                        Edit
                        post
                    </h5>
                    <div class="card-body">
                        <form action="<?= url('admin/posts/update'); ?>"
                              method="POST"
                              enctype="multipart/form-data">
                            <input type="hidden"
                                   name="id"
                                   class="form-control"
                                   value="<?= $post->id ?>">
                            <div class="mb-3">
                                <label for="title"
                                       class="form-label">Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       placeholder="Title"
                                       value="<?= $post->title ?>">
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
                                    $post->content
                                    ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail"
                                       class="form-label">Thumbnail
                                    (optional)</label>
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
            <?php else: ?>
                <h1>
                    Not
                    found</h1>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php Core\View::render('layout/footer', ['admin' => true]); ?>
