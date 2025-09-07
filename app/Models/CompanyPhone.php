<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="CompanyPhone",
 *     title="CompanyPhone",
 *     description="Телефон компании",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="Primary key",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="company_id",
 *         type="integer",
 *         format="int64",
 *         description="ID компании, к которой привязан телефон",
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         description="Номер телефона",
 *         example="+1-202-555-0143"
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
 *     required={"company_id","phone"}
 * )
 */
class CompanyPhone extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'phone'];

    /**
     * Связь с компанией
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
