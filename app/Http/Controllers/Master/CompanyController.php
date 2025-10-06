<?php

namespace App\Http\Controllers\Master;

use App\Models\Company;

class CompanyController extends BaseController
{
    public function __construct()
    {
        $this->model = Company::class;
        $this->viewPath = 'companies';
    }

    
}