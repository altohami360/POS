<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Category;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Livewire\Component;

class Create extends Component
{
    public $search = "";
    public $category_id = "";
    public $client;


    public function render()
    {

        $products = Product::where([
            ['name', 'LIKE', '%' . $this->search . '%'],
            ['category_id', 'LIKE', '%' . $this->category_id . '%'],
        ])->latest()->paginate(10);


        return view('livewire.client.order.create', [
            'categories' => Category::all(),
            'products' => $products,
        ]);
    }

    public function store($id, $name, $price)
    {
        \Cart::session($this->client->id)->add(array(
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => 1,
            'attributes' => array(),
        ));
        $this->emit('addProduct');
    }
}
