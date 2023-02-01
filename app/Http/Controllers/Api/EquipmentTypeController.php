<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterEquipmentTypeRequest;
use App\Http\Resources\EquipmentTypeCollection;
use App\Services\EquipmentTypeService;

class EquipmentTypeController extends Controller
{
    /**
     * Список типов
     *
     * @return EquipmentTypeCollection
     */
    public function index(FilterEquipmentTypeRequest $request, EquipmentTypeService $service)
    {
        $typeItems = $service->getPaginate(5, $request->validated());
        return new EquipmentTypeCollection($typeItems);
    }
}
