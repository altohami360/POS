<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'pro 1',
            'description' => 'This kadun ajkskj asjndkjiod nkasdlkjhn kwakjzsf.',
            'purchase_price' => 2200,
            'sale_price' => 2600,
            'stock' => 50,
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'pro 2',
            'description' => 'This kadun ajkskj asjndkjiod nkasdlkjhn kwakjzsf.',
            'purchase_price' => 2000,
            'sale_price' => 2500,
            'stock' => 50,
            'category_id' => 2,
        ]);
        Product::create([
            'name' => 'pro 3',
            'description' => 'This kadun ajkskj asjndkjiod nkasdlkjhn kwakjzsf.',
            'purchase_price' => 1000,
            'sale_price' => 2000,
            'stock' => 50,
            'category_id' => 3,
        ]);
    }
}
