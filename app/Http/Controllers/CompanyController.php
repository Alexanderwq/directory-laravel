<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\SearchRequest;
use App\Http\Resources\CompanyDetailResource;
use App\Models\Company;
use App\Services\Company\SearchService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Tag(
 *     name="Companies",
 *     description="API для работы с компаниями"
 * )
 */
class CompanyController extends Controller
{
    public function __construct(private readonly SearchService $searchService)
    {}

    /**
     * @OA\Get(
     *     path="/api/companies",
     *     operationId="getCompaniesList",
     *     tags={"Companies"},
     *     summary="Получить список компаний",
     *     description="Возвращает коллекцию компаний с возможностью поиска и фильтров",
     *     security={ {"bearer_token": {} }},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Фильтр по имени компании",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="ID категории для фильтрации, не использует потомков ищет только по текущей категории",
     *         required=false,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *      @OA\Parameter(
     *          name="categoryName",
     *          in="query",
     *          description="Имя категории для фильтрации, также ищет по дочерним категориям",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *         name="bbox",
     *         in="query",
     *         description="Bounding box для фильтрации по координатам: minLat,minLng,maxLat,maxLng",
     *         required=false,
     *         @OA\Schema(type="string", pattern="^-?\d+(\.\d+)?,-?\d+(\.\d+)?,-?\d+(\.\d+)?,-?\d+(\.\d+)?$")
     *     ),
     *     @OA\Parameter(
     *         name="building_id",
     *         in="query",
     *         description="ID здания для фильтрации",
     *         required=false,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список компаний",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Company")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Неверный запрос")
     * )
     */
    public function index(SearchRequest $request): AnonymousResourceCollection
    {
        $companies = $this->searchService->search($request);
        return CompanyDetailResource::collection($companies);
    }

    /**
     * @OA\Get(
     *     path="/api/companies/{company}",
     *     operationId="getCompanyById",
     *     tags={"Companies"},
     *     summary="Получить детали компании",
     *     description="Возвращает детали компании по ID",
     *     security={ {"bearer_token": {} }},
     *     @OA\Parameter(
     *         name="company",
     *         in="path",
     *         description="ID компании",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Детали компании",
     *         @OA\JsonContent(ref="#/components/schemas/Company")
     *     ),
     *     @OA\Response(response=404, description="Компания не найдена")
     * )
     */
    public function show(Company $company): CompanyDetailResource
    {
        return new CompanyDetailResource($company);
    }
}
