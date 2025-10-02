<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Ticket extends Model
{
    use Filterable;

    protected $fillable = ['title', 'description', 'status', 'priority', 'company_id'];
    protected array $filterable = ['title', 'status', 'priority'];
}