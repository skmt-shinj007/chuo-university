<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\Tag;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        // tag_id:1（部員タグ）を持っている全ユーザー 
        $club_member_user = Tag::find(1)->users()->get();
        return UserProfileResource::collection($club_member_user);
    }
}
