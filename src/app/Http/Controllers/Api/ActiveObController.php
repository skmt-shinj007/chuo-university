<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class ActiveObController extends Controller
{
    /**
     * user_id(51:丸中 52:鈴木)のプロフィールリソースを返す
     */
    public function index()
    {
        $active_user = UserProfile::find([51,52]);
        return UserProfileResource::collection($active_user);
    }
}
