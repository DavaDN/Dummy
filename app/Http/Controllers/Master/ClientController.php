<?php

namespace App\Http\Controllers\Master;

use App\Models\Client;

class ClientController extends BaseController
{
    public function __construct()
    {
        $this->model = Client::class;
        $this->viewPath = 'clients';
    }
}
