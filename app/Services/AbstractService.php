<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class AbstractService
{
    /**
     * Название класса модели
     *
     * @return String
     */
    abstract protected function model(): string;

    /**
     * Список полей с поддержкой поиска
     *
     * @return string[]
     */
    protected function fieldsForSearch(): array
    {
        return [];
    }

    protected function query(): \Illuminate\Database\Eloquent\Builder
    {
        return app($this->model())->query();
    }

    /**
     * Возвращает сущность по ID
     *
     * @param numeric $id
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getById($id): \Illuminate\Database\Eloquent\Model
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * Удаляет сущность
     *
     * @param numeric $id
     * @return void
     */
    public function deleteById($id)
    {
        $this->getById($id)->delete();
    }

    /**
     * Возвращает постраничный список
     *
     * @param int $perPage Количество элементов на страницу
     * @param array $filterFields Список полей для фильтрации
     * @return LengthAwarePaginator
     */
    public function getPaginate(int $perPage, array $filterFields): LengthAwarePaginator
    {
        $query = $this->query();
        $collection = collect($filterFields);
        if (!is_null($q = $collection->get('q'))) {
            /**
             * Поиск по одному значению в разных полях через ИЛИ
             */
            foreach ($this->fieldsForSearch() as $field) {
                $query->orWhere($field, $q);
            }
        } else {
            /**
             * Поиск по отдельным полям через И
             */
            foreach ($collection->only($this->fieldsForSearch()) as $field => $value) {
                $query->where($field, $value);
            }
        }
        return $query->paginate($perPage);
    }
}
