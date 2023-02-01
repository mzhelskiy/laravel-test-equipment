<?php

namespace App\Services;

use App\Models\Equipment;

class EquipmentService extends \App\Services\AbstractService
{
    /**
     * Список полей с поддержкой поиска
     *
     * @return string[]
     */
    protected function fieldsForSearch(): array
    {
        return ['id', 'equipment_type_id', 'serial_number'];
    }

    /**
     * Класс модели
     *
     * @return string
     */
    protected function model(): string
    {
        return Equipment::class;
    }

    /**
     * Создание модели
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        return $this->query()->create([
            'equipment_type_id' => $data['equipment_type_id'],
            'serial_number'     => $data['serial_number'],
            'desc'              => $data['desc'] ?? null,
        ]);
    }

    /**
     * Обновление модели
     *
     * @param numeric $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        $item = $this->getById($id);
        return $item->update([
            'equipment_type_id' => $data['equipment_type_id'],
            'serial_number'     => $data['serial_number'],
            'desc'              => $data['desc'] ?? null,
        ]);
    }
}
