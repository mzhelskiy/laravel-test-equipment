<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'equipment_type_id',
        'serial_number',
        'desc'
    ];

    /**
     * Тип
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
