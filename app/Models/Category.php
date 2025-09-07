<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Category",
 *     title="Category",
 *     description="Модель категории",
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
 *         description="Название категории",
 *         example="Электроника"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата создания",
 *         example="2025-09-07T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Дата обновления",
 *         example="2025-09-07T12:34:56Z"
 *     ),
 *     required={"name"}
 * )
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Родительские категории
     *
     * @return BelongsToMany
     */
    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_tree',
            'child_id',
            'parent_id',
        )->withPivot('depth');
    }

    /**
     * Компании, связанные с категорией
     *
     * @return BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_categories')
            ->withTimestamps();
    }
}
