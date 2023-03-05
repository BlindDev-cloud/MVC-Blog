<?php

declare(strict_types=1);

namespace App\Controllers\Account;

use App\Helpers\SessionHelper;
use Core\Controller;

class BaseController extends Controller
{
    protected ?array $fields = [];

    public function before(string $action): bool
    {
        $this->fields = filter_input_array(INPUT_POST, $_POST, true);

        return SessionHelper::isLoggedIn();
    }
}