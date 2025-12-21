<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\YearResource;
use App\Models\Year;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class YearController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return YearResource::collection(Year::all());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Year::create($validated);

        return $this->success("Year created successfully.", 201);
    }

    public function update(Request $request, Year $year): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'boolean'],
        ]);

        $year->update($validated);

        return $this->success("Year updated successfully.");
    }
}
