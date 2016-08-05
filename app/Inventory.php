<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\InventoryPrice;

class Inventory extends Model
{
    protected $table = 'inventory';

    public function product()
    {
        return $this->belongsTo(Product::class,'refpro');
    }
    public function inventoryPrice() {
        return $this->belongsToMany(InventoryPrice::class, 'inv_invprice','inventory_id','inventoryprice_id')->withTimeStamps();
    }
}
