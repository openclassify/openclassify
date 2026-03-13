<?php

namespace Modules\Panel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Listing\Models\Listing;

class UpdateListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(array_keys(Listing::panelStatusOptions()))],
            'contact_phone' => ['nullable', 'string', 'max:60'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'expires_at' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Listing title is required.',
            'price.numeric' => 'Listing price must be numeric.',
            'status.required' => 'Listing status is required.',
            'status.in' => 'Listing status is invalid.',
            'contact_email.email' => 'Contact email must be valid.',
            'expires_at.date' => 'Expiry date must be a valid date.',
        ];
    }
}
