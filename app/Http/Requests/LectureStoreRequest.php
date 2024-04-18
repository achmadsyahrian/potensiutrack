<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'nip' => 'required|numeric|integer',
            'email' => 'nullable|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'phone' => [
                'nullable',
                'regex:/^[0-9]{10,}$/',
                'unique:users,phone',
            ],
            'role_id' => 'nullable|exists:roles,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
