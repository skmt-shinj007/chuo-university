<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\UserProfile;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ObController extends Controller
{
    public function index()
    {
        $ob_user = UserProfile::whereHas('tags', function ($query) {
                        dd($query);
                        $query->where('tag_id', '>=', 13);
                    })->get();
        dump($ob_user);
        // return UserProfileResource::collection($ob_user);
        return;
    }
}
