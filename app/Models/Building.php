<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Building",
 *     title="Building",
 *     description="Модель здания",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Primary key",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="city",
 *         type="string",
 *         description="Город",
 *         example="New York"
 *     ),
 *     @OA\Property(
 *         property="street",
 *         type="string",
 *         description="Название улицы",
 *         example="Broadway"
 *     ),
 *     @OA\Property(
 *         property="house_number",
 *         type="string",
 *         description="Номер дома",
 *         example="123A"
 *     ),
 *     @OA\Property(
 *         property="lat",
 *         type="number",
 *         format="float",
 *         description="Latitude coordinate",
 *         example=40.712776
 *     ),
 *     @OA\Property(
 *         property="long",
 *         type="number",
 *         format="float",
 *         description="Longitude coordinate",
 *         example=-74.005974
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Время создания",
 *         example="2025-09-07T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Время обновления",
 *         example="2025-09-07T12:34:56Z"
 *     ),
 *     required={"city","street","house_number","lat","long"}
 * )
 */
class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'street',
        'house_number',
        'lat',
        'long',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
