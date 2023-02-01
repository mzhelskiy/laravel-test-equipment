<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterEquipmentRequest;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use App\Services\EquipmentService;

class EquipmentController extends Controller
{
    /**
     * @var EquipmentService
     */
    protected $service;

    public function __construct(EquipmentService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return EquipmentCollection
     */
    public function index(FilterEquipmentRequest $request)
    {
        $typeItems = $this->service->getPaginate(2, $request->validated());
        return new EquipmentCollection($typeItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEquipmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentRequest $request)
    {
        $success = [];
        $errors = $request->errors();
        foreach ($request->valid() as $k => $data) {
            try {
                $success[$k] = new EquipmentResource($this->service->store($data));
            } catch (\Exception $e) {
                /**
                 * Отлавливаем ошибки уровня фреймворка (вставка в БД и прочее)
                 */
                $errors[$k] = [$e->getMessage()];
            }
        }
        return response(['errors' => (object)$errors, 'success' => (object)$success]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return EquipmentResource
     */
    public function show($id)
    {
        $item = $this->service->getById($id);
        return new EquipmentResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return response(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->deleteById($id);
        return response(['success' => true]);
    }
}
