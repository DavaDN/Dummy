<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['email', 'password', 'company_id', 'reset_token'];

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

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'id');
    }
}
