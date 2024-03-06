<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

  protected $fillable = [
        'name',
        'tax_number',
        'tax_office',
        'phone',
        'email',
        'address'
    ];

  protected $hidden = [
        'pivot'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_company', 'company_id', 'user_id');
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'company_module', 'company_id', 'module_id');
    }

    public function moduleSettings(): BelongsTo
    {
        return $this->belongsTo(CompanyModuleSetting::class, 'company_id', 'id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
