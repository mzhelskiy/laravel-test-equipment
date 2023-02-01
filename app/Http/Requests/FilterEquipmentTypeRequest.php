<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запросов на фильтрацию списка equipmentType
 */
class FilterEquipmentTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'   => 'nullable|numeric|min:1',
            'name' => 'nullable|string|max:255',
            'q'    => 'nullable|string|max:255',
        ];
    }
}
