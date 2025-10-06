<?php

namespace App\Http\Controllers\Master;

use App\Models\Module;

class ModuleController extends BaseController
{
    public function __construct()
    {
        $this->model = Module::class;
        $this->viewPath = 'modules';
    }
}
