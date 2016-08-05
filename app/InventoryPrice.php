<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inventory;
class InventoryPrice extends Model
{
  protected $table = 'inventoryprice';
  
  public function inventory() {
      return $this->belongsToMany(Inventory::class, 'inv_invprice')->withTimeStamps();
  }
}
