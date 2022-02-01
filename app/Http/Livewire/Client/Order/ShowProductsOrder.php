<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\OrderItem;
use Livewire\Component;

class ShowProductsOrder extends Component
{
    public $order_items = [];

    protected $listeners  = ['orderItems' => 'items'];

    public function items($order_id)
    {
        // dd(true);
        $this->order_items = OrderItem::where('order_id', $order_id)->get();
    }
    public function render()
    {
        return view('livewire.client.order.show-products-order');
    }
}
