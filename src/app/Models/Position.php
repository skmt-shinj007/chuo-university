<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_id',
        'name_ja',
        'name_en',
        'color_name'
    ];

    /**
     * primary key
     * 
     * @var string
     */
    protected $primaryKey = 'position_id';

    /**
     * userProfile relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile(): HasMany
    {
        return $this->hasMany(UserProfile::class, 'position_id', 'position_id');
    }
}
