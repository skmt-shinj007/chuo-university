<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\Tag;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * 部員タグを持っているユーザーのプロフィールリソースを返す
     */
    public function index()
    {
        $club_member_user = Tag::find(1)->users()->get();
        return UserProfileResource::collection($club_member_user);
    }
}
