<div class="dropdown">
    <button class="btn dropdown-toggle text-light"
            style="background-color: #002030;"
            type="button"
            id="dropdownMenuButtonCategories"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="true">
        Categories
    </button>
    <ul class="dropdown-menu"
        aria-labelledby="dropdownMenuButtonCategories">
        <li>
            <a class="dropdown-item"
               href="<?= url('admin/categories'); ?>">
                All Categories
            </a>
        </li>
        <li>
            <a class="dropdown-item"
               href="<?= url('admin/categories/create'); ?>">
                New
                Category
            </a>
        </li>
    </ul>
</div>

<div class="dropdown">
    <button class="btn dropdown-toggle text-light"
            style="background-color: #002030;"
            type="button"
            id="dropdownMenuButtonPosts"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="true">
        Posts
    </button>
    <ul class="dropdown-menu"
        aria-labelledby="dropdownMenuButtonPosts">
        <li>
            <a class="dropdown-item"
               href="<?= url('admin/posts'); ?>">
                All
                Posts
            </a>
        </li>
        <li>
            <a class="dropdown-item"
               href="<?= url('admin/posts/create'); ?>">
                New
                Post
            </a>
        </li>
    </ul>
</div>

