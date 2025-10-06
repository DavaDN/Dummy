<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['company_id', 'name', 'draft_content', 'status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Relations
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'modules', 'id', 'module_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'id');
    }
}
