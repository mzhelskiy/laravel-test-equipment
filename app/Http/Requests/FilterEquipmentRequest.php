<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запросов на фильтрацию списка equipment
 */
class FilterEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                => 'nullable|numeric|min:1',
            'equipment_type_id' => 'nullable|numeric|min:1',
            'serial_number'     => 'nullable|string|max:255',
            'q'                 => 'nullable|string|max:255',
        ];
    }
}
