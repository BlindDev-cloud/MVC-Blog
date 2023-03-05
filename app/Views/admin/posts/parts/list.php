<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">
            ID
        </th>
        <th scope="col">
            Title
        </th>
        <th scope="col">
            Created
            at
        </th>
        <th scope="col">
            Actions
        </th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <tr>
                <th scope="row"><?= $post->id ?></th>
                <td><?= $post->title ?></td>
                <td><?= $post->created_at ?></td>
                <td>
                    <a href="<?= url('admin/posts/show?id=' . $post->id); ?>"
                       class="btn btn-primary">Show</a>
                    <a href="<?= url('admin/posts/edit?id=' . $post->id); ?>"
                       class="btn btn-secondary">Edit</a>
                    <div class="d-inline-flex ml-5">
                        <form action="<?= url('admin/posts/remove'); ?>"
                              method="POST">
                            <input type="hidden"
                                   name="id"
                                   id="id"
                                   class="form-control"
                                   value="<?= $post->id ?>">
                            <button type="submit"
                                    class="btn btn-danger">
                                Remove
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
