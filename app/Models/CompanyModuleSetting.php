<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModuleSetting extends Model
{
    use HasFactory;

    protected $casts = [
        'settings' => 'array'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }


}
