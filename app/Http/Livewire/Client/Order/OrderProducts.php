<?php

namespace App\Http\Livewire\Client\Order;

use Livewire\Component;

class OrderProducts extends Component
{
    public $client;

    public array $quantity = [];


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
