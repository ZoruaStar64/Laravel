<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:128', 'regex:/^[a-zA-Z][a-zA-Z\d\-]+[a-zA-Z\d]$/'],
            'email' => ['required', 'string', 'min:11', 'max:128'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'max:128'],
        ];
    }
}
