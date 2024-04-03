<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
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
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,' . auth()->user()->id,
            'phone' => [
                'nullable',
                'regex:/^[0-9]{10,}$/',
                'unique:users,phone,' . auth()->user()->id,
            ],
            'username' => 'required|unique:users,username,' . auth()->user()->id,
            'photo' => [
                'nullable',
                'image',
                'max:2048' //2MB
            ],
        ];
    }
}
