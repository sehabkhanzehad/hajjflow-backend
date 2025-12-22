<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class EmployeeSectionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return SectionResource::collection(Section::typeEmployee()->with('employee')->paginate($request->get('per_page', 10)));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:sections,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:employees,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:100'],
            'hire_date' => ['nullable', 'date'],
            'status' => ['nullable', 'boolean'],
        ]);

        $section = Section::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'type' => \App\Enums\SectionType::Employee,
        ]);

        $section->employee()->create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'position' => $validated['position'] ?? null,
            'hire_date' => $validated['hire_date'] ?? null,
            'status' => $validated['status'] ?? true,
        ]);

        return $this->success("Employee section created successfully.", 201);
    }

    public function update(Request $request, Section $section): JsonResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('sections', 'code')->ignore($section->id)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($section->employee->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:100'],
            'hire_date' => ['nullable', 'date'],
            'status' => ['nullable', 'boolean'],
        ]);

        $section->update([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        $section->employee->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'position' => $validated['position'] ?? null,
            'hire_date' => $validated['hire_date'] ?? null,
            'status' => $validated['status'] ?? $section->employee->status,
        ]);

        return $this->success("Employee section updated successfully.");
    }
}
