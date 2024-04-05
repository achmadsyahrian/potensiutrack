<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairRequestStoreRequest extends FormRequest
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
            'inventory_code' => 'required',
            'date' => 'required|date',
            'return_date' => 'nullable|date',
            'requested_by' => 'required|exists:users,id',
            'technician_id' => 'required|exists:users,id',
            'division_id' => 'required|exists:divisions,id',
            'item_inventory_id' => 'required|exists:item_inventories,id',
            'fault_description' => 'nullable',
            'repair_solution' => 'nullable',
            // 'repair_solution' => 'nullable',
        ];
    }
}
