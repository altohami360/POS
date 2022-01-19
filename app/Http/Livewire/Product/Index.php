<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $category_id = "";
    public $product_name = '';
    public $product_id = '';

    public function render()
    {
        $products = Product::where([
            ['name', 'LIKE', '%' . $this->search . '%'],
            ['category_id', 'LIKE', '%' . $this->category_id . '%'],
        ])->latest()->paginate(10);

        return view('livewire.product.index', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }
    public function deleteProduct()
    {
        $product = Product::findOrFail($this->product_id);

        if (File::exists('storage/' . $product->image)) {
            File::delete('storage/' . $product->image);
        }

        $product->delete();

        session()->flash('message', 'Delete Product Successfully');
    }

    public function setAtt($id, $name)
    {
        $this->product_id = $id;
        $this->product_name = $name;
    }
}
