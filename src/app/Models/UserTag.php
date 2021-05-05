<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileTag extends Model
{
    use HasFactory;

    /**
     * table name
     */
    protected $table = 'user_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'tag_id'
    ];

    /**
     * primary key
     * 
     * @var string
     */
    protected $primaryKey = 'id';
    
}
