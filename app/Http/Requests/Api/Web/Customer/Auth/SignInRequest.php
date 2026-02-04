<?php

namespace App\Http\Requests\Api\Web\Customer\Auth;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class SignInRequest extends FormRequest
{
    private ?Customer $customer = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }

    public function authenticate(): bool
    {
        $customer = Customer::where('email', $this->email)->first();

        if (!$customer || !Hash::check($this->password, $customer->password)) return false;

        $this->customer = $customer;

        return true;
    }

    public function authenticatedUser(): ?Customer
    {
        return $this->customer;
    }
}
