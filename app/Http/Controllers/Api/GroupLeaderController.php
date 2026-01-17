<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\GroupLeaderResource;
use App\Models\GroupLeader;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupLeaderController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return GroupLeaderResource::collection(
            GroupLeader::with([
                'user',
                'section'
            ])->withCount([
                'activePreRegistrations as active_pre_registrations_count',
                'registrations'
            ])->paginate(perPage())
        );
    }
}
