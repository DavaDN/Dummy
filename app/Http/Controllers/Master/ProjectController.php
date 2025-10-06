<?php

namespace App\Http\Controllers\Master;

use App\Models\Project;

class ProjectController extends BaseController
{
    public function __construct()
    {
        $this->model = Project::class;
        $this->viewPath = 'projects';
    }
}
