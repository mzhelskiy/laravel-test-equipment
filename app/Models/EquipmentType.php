<?php

namespace App\Models;

use App\Services\EquipmentTypeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    /**
     * Валидация серийоного номера на соответствие маски
     *
     * @param $number
     * @return bool
     */
    public function validateNumber($number): bool
    {
        $service = app(EquipmentTypeService::class);
        return $service->validateSerialNumber($number, $this->mask);
    }
}
