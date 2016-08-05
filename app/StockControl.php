<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;
class StockControl extends Model
{
    // Type of Stock StockControl
    const TYPE_IN = 1;
    const TYPE_OUT = 2;
    const TYPE_RETURN_IN = 3;
    const TYPE_RETURN_OUT = 4;

    protected $table = 'stockcontrol';
    protected $dates = ['created_at', 'updated_at', 'date'];
    protected $dateFormat = 'Y/m/d';

    public function product()
    {
        return $this->belongsTo(Product::class,'refpro');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'refsup');
    }

    public function assignRequest(Request $request) {
        if($request->id != null) {
            $this->id = $request->id;
            $stockControl= StockControl::find($request->id);
        }
        $this->date = $request->date;
        $this->price = $request->price;
        $this->qty = $request->qty;
        $this->refpro = $request->refpro;
        $this->refsup = $request->refsup;
    }
}
