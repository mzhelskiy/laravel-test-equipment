<?php

namespace App\Rules;

use App\Models\EquipmentType;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class SerialNumber implements Rule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /**
         * Формируем ключ для связанных данных (тип)
         */
        $keyType = 'equipment_type_id';
        $keyPart = explode('.', $attribute);
        if (count($keyPart) == 2) {
            $keyType = $keyPart[0] . '.' . $keyType;
        } elseif (count($keyPart) > 2) {
            return false;
        }
        /**
         * Получаем связанный тип по ключу и валидируем серийный номер по маске
         */
        if ($type = EquipmentType::query()->find(data_get($this->data, $keyType))) {
            if ($type->validateNumber($value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be correct format';
    }
}
