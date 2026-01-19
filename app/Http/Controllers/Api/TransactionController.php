<?php

namespace App\Http\Controllers\Api;

use App\Enums\SectionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransactionRequest;
use App\Http\Resources\Api\GroupLeaderResource;
use App\Http\Resources\Api\PilgrimResource;
use App\Http\Resources\Api\RegistrationResource;
use App\Http\Resources\Api\SectionResource;
use App\Http\Resources\Api\TransactionResource;
use App\Models\PreRegistration;
use App\Models\Registration;
use App\Models\Section;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TransactionResource::collection(
            Transaction::with(['section', 'references.referenceable'])
                ->latest()
                ->paginate(perPage())
        );
    }

    public function sections(): AnonymousResourceCollection
    {
        return SectionResource::collection(Section::whereIn('type', [
            SectionType::Other,
            SectionType::Employee,
            SectionType::Bill,
        ])->orderBy('name')->get());
    }


    public function preRegistrations(): JsonResponse
    {
        $preRegistrations = PreRegistration::with('pilgrim.user', 'groupLeader')->get()->map(function ($preRegistration) {
            return [
                "type" => "pre-registration",
                "id" => $preRegistration->id,
                "attributes" => [
                    "serialNo" => $preRegistration->serial_no,
                    "bankVoucherNo" => $preRegistration->bank_voucher_no,
                    "date" => $preRegistration->date,
                ],
                "relationships" => [
                    "pilgrim" => new PilgrimResource($preRegistration->relationLoaded('pilgrim') ? $preRegistration->pilgrim : null),
                    "groupLeader" => new GroupLeaderResource($preRegistration->relationLoaded('groupLeader') ? $preRegistration->groupLeader : null),
                ],
            ];
        });

        return response()->json(['data' => $preRegistrations]);
    }

    public function registrations(): AnonymousResourceCollection
    {
        return RegistrationResource::collection(Registration::with('pilgrim.user')
            ->latest()
            ->get());
    }

    public function store(TransactionRequest $request): JsonResponse
    {
        $section = $request->section();

        if ($section->isloan()) {
            // Todo: Implement loan transaction  
            //Handle Loan specific logic like deducting amount from loan balance
            return $this->error('Loan section transactions are not supported yet.', 400);
        }

        // $isIncome = $request->type === 'income';

        $transaction = $section->transactions()->create([
            'type' => $request->type,
            'voucher_no' => $request->voucher_no,
            'title' => $request->title,
            'description' => $request->description,
            'before_balance' => $section->currentBalance(),
            'amount' => $request->amount,
            'after_balance' => $section->afterBalance($request),
            'date' => $request->date,
        ]);

        $transaction->addReferences($request);



        return $this->success("Transaction created successfully.", 201);
    }

    // 301.1/income                      | before balance|amount|after balance
    //11-12-2025 | Md Abu Bakar Siddique | 0             |1000  | 1000,
    //12-12-2025 | Md Abu Bakar Siddique | 1000          |500   | 1500

    public function update(Request $request, Transaction $transaction): JsonResponse
    {
        $request->validate([
            'voucher_no' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $transaction->update([
            'voucher_no' => $request->voucher_no,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $this->success("Transaction updated successfully.");
    }
}
