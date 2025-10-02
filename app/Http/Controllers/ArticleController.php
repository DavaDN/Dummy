<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends BaseController
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }
}
