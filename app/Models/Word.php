<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'japanese',
        'pronunciation',
        'tpye',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
    }
}
