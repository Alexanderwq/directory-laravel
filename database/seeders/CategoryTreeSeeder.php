<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTreeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('category_tree')->delete();
        Category::query()->delete();

        $tree = [
            'Еда' => [
                'Мясная продукция' => [],
                'Молочная продукция' => [],
            ],
            'Автомобили' => [
                'Грузовые' => [],
                'Легковые' => [
                    'Запчасти' => [],
                    'Аксессуары' => [],
                ],
            ],
        ];

        foreach ($tree as $rootName => $children) {
            $this->createCategoryWithChildren($rootName, $children);
        }
    }

    private function createCategoryWithChildren(string $name, array $children, ?int $parentId = null): int
    {
        $category = Category::factory()->create(['name' => $name]);

        DB::table('category_tree')->insert([
            'parent_id' => $category->id,
            'child_id'  => $category->id,
            'depth'     => 0,
        ]);

        if ($parentId) {
            DB::table('category_tree')->insertUsing(
                ['parent_id', 'child_id', 'depth'],
                DB::table('category_tree')
                    ->select('parent_id', DB::raw($category->id), DB::raw('depth + 1'))
                    ->where('child_id', $parentId)
            );
        }

        foreach ($children as $childName => $childChildren) {
            $this->createCategoryWithChildren($childName, $childChildren, $category->id);
        }

        return $category->id;
    }
}
