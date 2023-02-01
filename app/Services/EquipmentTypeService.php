<?php

namespace App\Services;

use App\Models\EquipmentType;

class EquipmentTypeService extends \App\Services\AbstractService
{
    /**
     * Список полей с поддержкой поиска
     *
     * @return string[]
     */
    protected function fieldsForSearch(): array
    {
        return ['id', 'name'];
    }

    /**
     * Класс модели
     *
     * @return string
     */
    protected function model(): string
    {
        return EquipmentType::class;
    }

    /**
     * Валидация серийоного номера по маске
     *
     * @param string $number
     * @param string $mask
     * @return bool
     */
    public function validateSerialNumber(string $number, string $mask): bool
    {
        $preg = $this->convertMaskToPreg($mask);
        if (preg_match('#^' . $preg . '$#', $number)) {
            return true;
        }
        return false;
    }

    /**
     * Конвертация маски в регулярное выражение
     *
     * @param string $mask
     * @return string
     */
    protected function convertMaskToPreg(string $mask): string
    {
        $replace = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[0-9A-Z]',
            'Z' => '[\-\_\@]',
        ];
        return strtr($mask, $replace);
    }
}
