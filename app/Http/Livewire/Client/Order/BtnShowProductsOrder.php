<?php

namespace App\Http\Livewire\Client\Order;

use Livewire\Component;

class BtnShowProductsOrder extends Component
{

    public $order_id;

    public function render()
    {
        return view('livewire.client.order.btn-show-products-order');
    }

    public function getOrderItems($order_id)
    {
        // dd(true);
        $this->emit('orderItems', $this->order_id);
    }
}
