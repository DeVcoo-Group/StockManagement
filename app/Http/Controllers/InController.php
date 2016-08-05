<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\StockControl;
use App\Inventory;
use App\Product;
use App\Supplier;
use Carbon\Carbon;
use Response;
use App\InventoryPrice;
class InController extends Controller
{
    protected $stockControl;

    public function inIndex(Request $request = null, $id = null) {
        $in = new StockControl;
        if(empty($id)) {
            $in->product = new Product;
            $in->supplier = new Supplier;
            $in->date = Carbon::today();
        } else {
            $in = StockControl::whereRaw('type = '. StockControl::TYPE_IN . ' and id = ?', array($id))->first();
            if(empty($in)) {
                abort(404);
            }
        }
        return view('inForm')->with('in',$in);;
    }

    public function inShow($id)
    {
        $in = StockControl::find($id);
        if(empty($in)) {
            abort(404);
        }
        return view('inForm')->with('in',$in);
    }

    public function in(Request $request) {
        $stockControl = new StockControl;
        $stockControl->type = StockControl::TYPE_IN;
        $stockControl->assignRequest($request);

        $inventory = Inventory::where([['refpro',$request->refpro]])->get()->first();
        $priceFound = false;
        if(empty($inventory)) {
            $inventory = new Inventory;
            $inventory->refpro = $stockControl->refpro;
            $inventory->save();
        } else {
            $inventoryPrices = $inventory->inventoryPrice;
            foreach ($inventoryPrices as $value) {
                if($value->amount == $request->price) {
                    $priceFound = true;
                    $value->qty = $value->qty + $stockControl->qty;
                    $value->save();
                }
            }

        }
        if(!$priceFound) {
            $inventoryPrice = new InventoryPrice;
            $inventoryPrice->amount = $request->price;
            $inventoryPrice->qty = $request->qty;
            $inventoryPrice->save();
            $inventory->inventoryPrice()->attach($inventoryPrice->id);
        }
        $stockControl->save();
        return view('inForm')->with('in',$stockControl);
    }

    public function returnIn(Request $request) {
        $importForReturn = StockControl::find($request->id);
        $stockReturn = new StockControl;
        $stockReturn->price = $importForReturn->price;
        $stockReturn->qty = $importForReturn->qty;
        $stockReturn->type = StockControl::TYPE_RETURN_IN;
        $stockReturn->refpro = $importForReturn->refpro;
        $stockReturn->refsup = $importForReturn->refsup;
        $stockReturn->date = Carbon::now();
        $stockReturn->refreturn = $importForReturn->id;

        $priceFound = false;
        $inventory = Inventory::where([['refpro',$request->refpro]])->get()->first();
        if(empty($inventory) || empty($importForReturn)) {
            abort(404, 'inventory is empty');
        } else {
            if($importForReturn->qty == $stockReturn->qty) {
                foreach ($inventory->inventoryPrice as $value) {
                    if($value->amount == $stockReturn->price) {
                        $value->qty = $value->qty - $stockReturn->qty;
                        $value->save();
                        $priceFound = true;
                        break;
                    }
                }
            }
        }
        if($priceFound) {
            $stockReturn->save();
            $importForReturn->refreturn = $stockReturn->id;
            $importForReturn->save();
        } else {
            abort(404,'price not found');
        }
        return view('inForm')->with('in',$importForReturn);
    }
}
