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

class OutController extends Controller
{
    protected $stockControl;

    public function outIndex(Request $request = null, $id = null) {
        if(empty($id)) {
            $out = new StockControl;
            $out->product = new Product;
            // $out->supplier = new Supplier;
            $out->date = Carbon::today();
        } else {
            $out = StockControl::whereRaw('type = '. StockControl::TYPE_OUT . ' and id = ?', array($id))->first();
            if(empty($out)) {
                abort(404);
            }
        }
        return view('outForm')->with('out',$out);
    }

    public function outShow($id) {
        $out = StockControl::find($id);
        if(empty($out)) {
            abort(404);
        }
        return view('outForm')->with('out',$out);
    }

    public function out(Request $request) {
        $stockControl = new StockControl;
        $stockControl->assignRequest($request);
        $stockControl->type = StockControl::TYPE_OUT;

        $inventory = Inventory::where([['refpro',$request->refpro]])->get()->first();
        $priceFound = false;
        if(empty($inventory)) {
            abort(404);
        } else {
            $inventoryPrices = $inventory->inventoryPrice;
            foreach ($inventoryPrices as $value) {
                if($value->amount == $request->price) {
                    if($value->qty >= $stockControl->qty) {
                        $value->qty = $value->qty - $stockControl->qty;
                        $value->save();
                        $priceFound = true;
                        break;
                    }
                }
            }
        }
        if($priceFound) {
            $stockControl->save();
        } else {
            //price not found
            abort(404, 'inventory is empty');
        }
        return view('outForm')->with('out',$stockControl);
    }

    public function returnOut(Request $request) {
        $outForReturn = StockControl::find($request->id);
        $stockReturn = new StockControl;
        $stockReturn->price = $outForReturn->price;
        $stockReturn->qty = $outForReturn->qty;
        $stockReturn->type = StockControl::TYPE_RETURN_OUT;
        $stockReturn->refpro = $outForReturn->refpro;
        // $stockReturn->refsup = $outForReturn->refsup;
        $stockReturn->date = Carbon::now();
        $stockReturn->refreturn = $outForReturn->id;

        $priceFound = false;
        $inventory = Inventory::where([['refpro',$request->refpro]])->get()->first();
        if(empty($inventory) || empty($outForReturn)) {
            abort(404);
        } else {
            if($outForReturn->qty == $stockReturn->qty) {
                foreach ($inventory->inventoryPrice as $value) {
                    if($value->amount == $stockReturn->price) {
                        $priceFound = true;
                        $value->qty = $value->qty + $stockReturn->qty;
                        $value->save();
                        break;
                    }
                }
            }
        }
        if($priceFound) {
            $stockReturn->save();
            $outForReturn->refreturn = $stockReturn->id;
            $outForReturn->save();
        } else {
            abort(404);
        }
        return view('outForm')->with('out',$outForReturn);
    }
}
