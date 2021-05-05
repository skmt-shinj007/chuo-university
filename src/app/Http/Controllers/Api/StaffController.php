<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff_tag_user = Tag::find(7)->users()->get();
        return UserProfileResource::collection($staff_tag_user);
    }
}
