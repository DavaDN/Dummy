<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_modules', 'id', 'project_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'id');
    }
}
