<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">
            ID
        </th>
        <th scope="col">
            Name
        </th>
        <th scope="col">
            Actions
        </th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <tr>
                <th scope="row">
                    <?= $category->id; ?>
                </th>
                <td>
                    <a href="<?= url('admin/posts/by_category?id=' . $category->id . '&title=' . $category->title); ?>"
                    class="link-light bg-dark">
                        <?= $category->title; ?>
                    </a>
                </td>
                <td>
                    <a href="<?= url('admin/categories/show?id=' . $category->id); ?>"
                       class="btn btn-primary">Show</a>
                    <a href="<?= url('admin/categories/edit?id=' . $category->id); ?>"
                       class="btn btn-secondary">Edit</a>
                    <div class="d-inline-flex ml-5">
                        <form action="<?= url('admin/categories/remove'); ?>"
                              method="POST">
                            <input type="hidden"
                                   name="id"
                                   id="id"
                                   class="form-control"
                                   value="<?= $category->id ?>">
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
