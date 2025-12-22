<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class BillSectionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return SectionResource::collection(Section::typeBill()->with('bill')->paginate($request->get('per_page', 10)));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:sections,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'number' => ['required', 'string', 'max:100', 'unique:bills,number'],
            'biller_name' => ['required', 'string', 'max:255'],
        ]);

        $section = Section::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'type' => \App\Enums\SectionType::Bill,
        ]);

        $section->bill()->create([
            'number' => $validated['number'],
            'biller_name' => $validated['biller_name'],
        ]);

        return $this->success("Bill section created successfully.", 201);
    }

    public function update(Request $request, Section $section): JsonResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('sections', 'code')->ignore($section->id)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'number' => ['required', 'string', 'max:100', Rule::unique('bills', 'number')->ignore($section->bill->id)],
            'biller_name' => ['required', 'string', 'max:255'],
        ]);

        $section->update([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        $section->bill->update([
            'number' => $validated['number'],
            'biller_name' => $validated['biller_name'],
        ]);

        return $this->success("Bill section updated successfully.");
    }
}
