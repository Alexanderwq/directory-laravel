<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\BuildingDetailResource;

/**
 * @OA\Tag(
 *     name="Buildings",
 *     description="API для работы со зданиями"
 * )
 */
readonly class BuildingController
{
    /**
     * @OA\Get(
     *     path="/api/buildings",
     *     tags={"Buildings"},
     *     summary="Список зданий",
     *     security={ {"bearer_token": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Список зданий",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Building")
     *         )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return BuildingDetailResource::collection(Building::all());
    }

    /**
     * @OA\Get(
     *     path="/api/buildings/{id}",
     *     tags={"Buildings"},
     *     summary="Показать здание",
     *     security={ {"bearer_token": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Детали здания",
     *         @OA\JsonContent(ref="#/components/schemas/Building")
     *     )
     * )
     */
    public function show(Building $building): BuildingDetailResource
    {
        return new BuildingDetailResource($building);
    }
}
