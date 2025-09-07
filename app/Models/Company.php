<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Company",
 *     title="Company",
 *     description="Модель компании",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Primary key",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Название компании",
 *         example="Acme Inc."
 *     ),
 *     @OA\Property(
 *         property="building_id",
 *         type="integer",
 *         format="int64",
 *         description="ID здания, где находится компания",
 *         nullable=true,
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="office_number",
 *         type="string",
 *         description="Номер офиса",
 *         nullable=true,
 *         example="15B"
 *     ),
 *     @OA\Property(
 *         property="lat",
 *         type="number",
 *         format="float",
 *         description="Широта компании",
 *         example=40.712776
 *     ),
 *     @OA\Property(
 *         property="long",
 *         type="number",
 *         format="float",
 *         description="Долгота компании",
 *         example=-74.005974
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата создания записи",
 *         example="2025-09-07T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата обновления записи",
 *         example="2025-09-07T12:34:56Z"
 *     ),
 *     required={"name","lat","long"}
 * )
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building_id',
        'office_number',
        'lat',
        'long',
    ];

    /**
     * Связь с категориями
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'company_categories')
            ->withTimestamps();
    }

    /**
     * Связь с зданием
     *
     * @return BelongsTo
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * Полный адрес компании
     *
     * @return string
     */
    public function getFullAddress(): string
    {
        if (!$this->building) {
            return '';
        }

        $address = $this->building->city . ', '
            . $this->building->street . ' '
            . $this->building->house_number;

        return $this->office_number
            ? $address . ', офис ' . $this->office_number
            : $address;
    }
}
