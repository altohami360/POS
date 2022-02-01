<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['profit_percent'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function orderItem()
    // {
    //     return $this->belongsTo(OrderItem::class);
    // }

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    }
}
