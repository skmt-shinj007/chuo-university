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

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
