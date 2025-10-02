<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Invoice extends Model
{
    use Filterable;

    protected $fillable = ['invoice_number', 'status', 'amount', 'company_id'];
    protected array $filterable = ['invoice_number', 'status'];
}
