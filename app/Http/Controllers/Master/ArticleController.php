<?php

namespace App\Http\Controllers\Master;

use App\Models\Article;

class ArticleController extends BaseController
{
    public function __construct()
    {
        $this->model = Article::class;
        $this->viewPath = 'articles';
    }
}
