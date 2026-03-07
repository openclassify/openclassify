<?php

namespace Modules\User\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\User\App\Models\User;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique((new User())->getTable(), 'email')],
            'password' => ['required', Password::defaults()],
            'terms' => ['accepted'],
            'marketing_opt_in' => ['nullable', 'boolean'],
        ];
    }

    public function fullName(): string
    {
        return trim($this->string('first_name')->toString().' '.$this->string('last_name')->toString());
    }
}
