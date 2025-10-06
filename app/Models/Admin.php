<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Admin extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['email', 'password', 'reset_token'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function approvedTickets()
    {
        return $this->hasMany(Ticket::class, 'approved_by');
    }

    public function approvedInvoices()
    {
        return $this->hasMany(Invoice::class, 'approved_by');
    }
}
