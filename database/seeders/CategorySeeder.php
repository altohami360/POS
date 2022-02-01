<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'cate 1',
            'active' => true,
        ]);

        Category::create([
            'name' => 'cate 2',
            'active' => true,
        ]);

        Category::create([
            'name' => 'cate 3',
            'active' => true,
        ]);

        Category::create([
            'name' => 'cate 4',
            'active' => true,
        ]);

        Category::create([
            'name' => 'cate 5',
            'active' => true,
        ]);
    }
}
