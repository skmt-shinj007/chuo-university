<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'first_name_ja',
        'last_name_ja',
        'first_name_kana',
        'last_name_kana',
        'first_name_en',
        'last_name_en',
        'graduation_year',
        'grade',
        'position_id',
        'prefecture_id',
        'alma_mater',
        'achievement',
    ];

    protected $primaryKey = 'user_id';

    /**
     * user rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * position rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class)->withDefault();
    }

    /**
     * UserProfile rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'prefecture_id', 'prefecture_id')->withDefault();
    }

    // /**
    //  * prefecture relation
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function prefecture(): HasMany
    // {
    //     return $this->hasMany(Prefecture::class);
    // }
}
