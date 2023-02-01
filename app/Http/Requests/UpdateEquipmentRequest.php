<?php

namespace App\Http\Requests;

use App\Rules\SerialNumber;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация обновления Equipment
 */
class UpdateEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'equipment_type_id' => 'required|integer|exists:App\Models\EquipmentType,id',
            'serial_number'     => [
                'required',
                'string',
                'max:255',
                new SerialNumber
            ],
            'desc'              => 'nullable|string|max:5000',
        ];
    }

    public function attributes()
    {
        return [
            'serial_number'     => 'serial number',
            'equipment_type_id' => 'type',
            'desc'              => 'description',
        ];
    }
}
