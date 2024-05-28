<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureUpdateRequest extends FormRequest
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
        $id = $this->input('id');

        return [
            'name' => 'required|min:3',
            'nip' => 'required|string|numeric',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'phone' => [
                'nullable',
                'regex:/^[0-9]{10,}$/',
                'unique:users,phone,' . $id,
            ],
            'username' => 'required|min:5|unique:users,username,' . $id,
            'photo' => [
                'nullable',
                'image',
                'max:2048' //2MB
            ],
        ];
    }
}
