<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\Tag;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ObController extends Controller
{
    const OB_TAG_ID = 13;
    
    /**
     * OBタグを持っているユーザーのプロフィールリソースを返す
     */
    public function index()
    {
        $ob_user = Tag::find(self::OB_TAG_ID)->users()->get();
        return UserProfileResource::collection($ob_user);
    }
}
