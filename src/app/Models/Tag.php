<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'name_ja',
        'name_en'
    ];

    /**
     * primary key
     * 
     * @var string
     */
    protected $primaryKey = 'tag_id';

    /**
     * UserProfile rilation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(UserProfile::class, 'user_tags', 'tag_id', 'user_id');
    }

}
