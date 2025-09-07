<?php

namespace App\Services\Company;

use App\Http\Requests\Company\SearchRequest;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SearchService
{
    public function search(SearchRequest $request): Collection
    {
        return Company::with(['categories', 'building'])
            ->when($request->filled('category'), function (Builder $query) use ($request) {
                $query->whereHas('categories', fn(Builder $q) => $q->where('category_id', $request->get('category')));
            })
            ->when($request->filled('bbox'), function (Builder $query) use ($request) {
                [$west, $south, $east, $north] = array_map('floatval', explode(',', $request->get('bbox')));

                $query->whereBetween('long', [$west, $east])
                    ->whereBetween('lat', [$south, $north]);
            })
            ->when($request->filled('name'), function (Builder $query) use ($request) {
                $query->where('name', 'like', '%' . $request->get('name') . '%');
            })
            ->when($request->filled('categoryName'), function (Builder $query) use ($request) {
                $categoryName = $request->get('categoryName');

                $category = Category::where('name', $categoryName)->first();

                if ($category) {
                    $categoryIds = DB::table('category_tree')
                        ->where('parent_id', $category->id)
                        ->pluck('child_id')
                        ->toArray();

                    $categoryIds[] = $category->id;

                    $query->whereHas('categories', function (Builder $query) use ($categoryIds) {
                        $query->whereIn('categories.id', $categoryIds);
                    });
                }
            })
            ->when($request->filled('building_id'), function (Builder $query) use ($request) {
                $query->where('building_id', $request->get('building_id'));
            })
            ->get();
    }
}
