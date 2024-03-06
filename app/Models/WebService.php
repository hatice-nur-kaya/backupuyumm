<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebService extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];



    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
