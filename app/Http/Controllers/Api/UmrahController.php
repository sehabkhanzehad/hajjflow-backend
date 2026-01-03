<?php

namespace App\Http\Controllers\Api;

use App\Enums\PilgrimLogType;
use App\Enums\UmrahStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UmrahResource;
use App\Models\GroupLeader;
use App\Models\Package;
use App\Models\Pilgrim;
use App\Models\PilgrimLog;
use App\Models\Umrah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class UmrahController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UmrahResource::collection(Umrah::with(['year', 'groupLeader', 'pilgrim.user', 'package'])->paginate(request()->get('per_page', 10)));
    }

    public function packages(): JsonResponse
    {
        $packages = Package::umrah()->active()->get()->map(function ($package) {
            return [
                "type" => "package",
                "id" => $package->id,
                "attributes" => [
                    "name" => $package->name,
                    "price" => $package->price,
                ],
            ];
        });

        return response()->json(['data' => $packages]);
    }

    public function groupLeaders(): JsonResponse
    {
        $groupLeaders = GroupLeader::all()->map(function ($groupLeader) {
            return [
                'type' => 'group-leader',
                'id' => $groupLeader->id,
                'attributes' => [
                    'groupName' => $groupLeader->group_name,
                ],
            ];
        });

        return response()->json(['data' => $groupLeaders]);
    }

    public function pilgrims(): JsonResponse
    {
        $pilgrims = User::whereHas('pilgrim')->get()->map(function ($user) {
            return [
                'type' => 'pilgrim',
                'id' => $user->pilgrim->id,
                'attributes' => [
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ],
            ];
        });

        return response()->json(['data' => $pilgrims]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'group_leader_id' => ['required', 'exists:group_leaders,id'],
            'pilgrim_id' => ['nullable', 'exists:pilgrims,id'],
            'new_pilgrim' => ['required_without:pilgrim_id', 'array'],
            'new_pilgrim.first_name' => ['required_with:new_pilgrim', 'string'],
            'new_pilgrim.last_name' => ['nullable', 'string'],
            'new_pilgrim.email' => ['nullable', 'email', 'unique:users,email'],
            'new_pilgrim.phone' => ['nullable', 'string'],
            'new_pilgrim.gender' => ['required_with:new_pilgrim', 'in:male,female,other'],
            'new_pilgrim.is_married' => ['nullable', 'boolean'],
            'new_pilgrim.nid' => ['nullable', 'string', 'unique:users,nid'],
            'new_pilgrim.date_of_birth' => ['nullable', 'date'],
            'package_id' => ['required', 'exists:packages,id'],
        ]);

        if ($request->has('pilgrim_id')) {
            $pilgrimId = $validated['pilgrim_id'];
            $pilgrim = Pilgrim::find($pilgrimId);
        } else {
            $user = User::create([
                'first_name' => $validated['new_pilgrim']['first_name'],
                'last_name' => $validated['new_pilgrim']['last_name'] ?? null,
                'email' => $validated['new_pilgrim']['email'] ?? null,
                'phone' => $validated['new_pilgrim']['phone'] ?? null,
                'gender' => $validated['new_pilgrim']['gender'],
                'is_married' => $validated['new_pilgrim']['is_married'] ?? false,
                'nid' => $validated['new_pilgrim']['nid'] ?? null,
                'date_of_birth' => $validated['new_pilgrim']['date_of_birth'] ?? null,
            ]);
            $pilgrim = $user->pilgrim()->create();
            $pilgrimId = $pilgrim->id;
        }

        $umrah = Umrah::create([
            'group_leader_id' => $validated['group_leader_id'],
            'pilgrim_id' => $pilgrimId,
            'package_id' => $validated['package_id'],
            'status' => UmrahStatus::Registered,
        ]);

        PilgrimLog::add(
            $pilgrim,
            $umrah->id,
            Umrah::class,
            PilgrimLogType::UmrahRegistered,
            "উমরাহ রেজিস্ট্রেশন সম্পন্ন হয়েছে।"
        );

        return $this->success("Umrah created successfully.");
    }

    public function update(Request $request, Umrah $umrah): JsonResponse
    {
        $validated = $request->validate([
            'group_leader_id' => ['required', 'exists:group_leaders,id'],
            'pilgrim_id' => ['required', 'exists:pilgrims,id'],
            'package_id' => ['required', 'exists:packages,id'],
        ]);

        $umrah->update($validated);

        return $this->success("Umrah updated successfully.");
    }

    public function destroy(Umrah $umrah): JsonResponse
    {
        return $this->error("Umrah deletion is currently under maintenance.");

        // $umrah->delete();
        //delete pilgrim if no other records
        // deltete user if no other records

        // return $this->success("Umrah deleted successfully.");
    }
}
