<?php

namespace App\Http\Requests;

use App\Rules\SerialNumber;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация создания Equipment
 */
class StoreEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.equipment_type_id' => 'required|integer|exists:App\Models\EquipmentType,id',
            '*.serial_number'     => [
                'required',
                'string',
                'max:255',
                new SerialNumber
            ],
            '*.desc'              => 'nullable|string|max:5000',
        ];
    }

    /**
     * Список валидных данных
     *
     * @return array
     */
    public function valid()
    {
        return $this->validator->valid();
    }

    /**
     * Список ошибок объединенных в один массив для каждого объекта
     *
     * @return array
     */
    public function errors()
    {
        $errors = [];
        foreach ($this->validator->invalid() as $k => $data) {
            $msgs = $this->validator->messages()->get("{$k}.*");
            $errors[$k] = array_reduce($msgs, function ($result, $items) {
                return array_merge($result, $items);
            }, []);
        }
        return $errors;
    }

    /**
     * Переопределяем метод для отключения выброса исключений валидации
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {

    }

    public function attributes()
    {
        return [
            '*.serial_number'     => 'serial number',
            '*.equipment_type_id' => 'type',
            '*.desc'              => 'description',
        ];
    }
}
