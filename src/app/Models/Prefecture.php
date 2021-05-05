<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\UserProfile;

class Prefecture extends Model
{
    use HasFactory;

    /**
     * table name
     */
    protected $table = 'prefectures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prefecture_id',
        'name_ja',
        'name_kana',
        'name_en'
    ];

    /**
     * primary key
     * 
     * @var string
     */
    protected $primaryKey = 'prefecture_id';

    /**
     * userProfile relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile(): HasMany
    {
        return $this->hasMany(UserProfile::class, 'prefecture_id', 'prefecture_id');
    }
}