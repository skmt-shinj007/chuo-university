<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Prefecture;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * table name
     */
    protected $table = 'user_profiles';

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
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * position rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }

    /**
     * UserProfile rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id', 'prefecture_id');
    }

    /**
     * tags rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'user_tags', 'user_id', 'tag_id');
    }
}
