<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryDetailResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Tag(
 *     name="Categories",
 *     description="API для работы с категориями"
 * )
 */
readonly class CategoryController
{
    /**
     * Получить список всех категорий
     *
     * @OA\Get(
     *     path="/api/categories",
     *     operationId="getCategoriesList",
     *     tags={"Categories"},
     *     summary="Список всех категорий",
     *     description="Возвращает коллекцию категорий",
     *     security={ {"bearer_token": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Category")
     *         )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryDetailResource::collection(Category::all());
    }

    /**
     * Получить детальную информацию о категории
     *
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     operationId="getCategoryById",
     *     tags={"Categories"},
     *     summary="Детальная информация о категории",
     *     description="Возвращает категорию по ID",
     *     security={ {"bearer_token": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID категории",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Категория не найдена"
     *     )
     * )
     */
    public function show(Category $category): CategoryDetailResource
    {
        return new CategoryDetailResource($category);
    }
}
