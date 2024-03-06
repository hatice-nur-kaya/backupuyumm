<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];


    public function webServices()
    {
        return $this->hasMany(WebService::class, 'module_id', 'id');
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'module_id', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_module', 'module_id', 'company_id');
    }

}
