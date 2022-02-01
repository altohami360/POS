<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\orderItems;
use App\Models\Product;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class OrderProducts extends Component
{
    public $client;

    // public array $quantity = [];


    protected $listeners = ['addProduct' => '$refresh'];


    public function render()
    {
        return view('livewire.client.order.order-products', [
            'orders' => \Cart::session($this->client->id)->getContent(),
        ]);
    }

    public function clear()
    {
        \Cart::session($this->client->id)->clear();
    }

    public function remove($id)
    {
        \Cart::session($this->client->id)->remove($id);
    }

    public function plus($id)
    {
        $gty = \Cart::session($this->client->id)->get($id)->quantity;
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $gty + 1,
            ]
        ]);
    }

    public function minus($id)
    {
        $gty = \Cart::session($this->client->id)->get($id)->quantity;

        $new_gty = ($gty > 1) ? $gty - 1 :  $gty = 1;

        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $new_gty,
            ]
        ]);
    }

    public function update($id)
    {
        dd(true);
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity,
            ]
        ]);
    }

    public function save()
    {
        $items = \Cart::session($this->client->id)->getContent();

        // if (isEmpty($items)) {
        //     dd($items);
        // }

        $order = Order::create([
            'client_id' => $this->client->id,
            'total_price' => \Cart::getTotal(),
        ]);

        foreach ($items as $item) {

            OrderItem::create([
                'product_id' => $item->id,
                'order_id' => $order->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);

            Product::find($item->id)->decrement('stock', $item->quantity);
        }

        \Cart::session($this->client->id)->clear();
        $this->reset('client');

        return redirect()->route('orders.index')->with('message', 'Add Order Successfully');
    }















    // public function up($id)
    // {

    //     \Cart::update($id, [
    //         'quantity' => [
    //             'relative' => false,
    //             'value' => \Cart::session($this->client->id)->get($id)->quantity + 1
    //         ]
    //     ]);
    // }
    // public function down($id)
    // {
    //     if (\Cart::session($this->client->id)->get($id)->quantity > 1) {
    //         $value = \Cart::session($this->client->id)->get($id)->quantity - 1;
    //     } else {
    //         $value = 1;
    //     }

    //     \Cart::update($id, [
    //         'quantity' => [
    //             'relative' => false,
    //             'value' => $value
    //         ]
    //     ]);
    //     $this->orders = \Cart::getContent();
    // }
    // public function update($id)
    // {
    //     \Cart::update($id, [
    //         'quantity' => [
    //             'relative' => false,
    //             'value' => $this->quantity,
    //         ]
    //     ]);
    // }
}
