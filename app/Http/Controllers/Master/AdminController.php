<?php

namespace App\Http\Controllers\Master;

use App\Models\Admin;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->model = Admin::class;
        $this->viewPath = 'admins';
    }
}
