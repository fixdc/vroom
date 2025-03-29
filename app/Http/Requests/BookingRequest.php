<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zip' => ['required', 'string'],
            'status' => ['required', 'in:pending,confirmed,done,cancelled'],
            'payment_method' => ['nullable', 'in:midtrans'],
            'payment_status' => ['nullable', 'in:pending,success,failed,expired'],
            'payment_url' => ['nullable', 'url'],
            'total_price' => ['nullable', 'numeric'],
            'item_id' => ['nullable', 'exists:items,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
