<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Article extends Model
{
    use Filterable;

    protected $fillable = ['title', 'content', 'category', 'company_id'];
    protected array $filterable = ['title', 'category'];
}