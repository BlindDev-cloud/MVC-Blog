<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\SessionHelper;
use Core\Controller;

class BaseController extends Controller
{
    public function before(string $action): bool
    {
        return SessionHelper::isAdmin();
    }
}