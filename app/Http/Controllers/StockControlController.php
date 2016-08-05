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
class StockControlController extends Controller {
    protected $stockControl;

    public function findWhere(Request $request) {
        $stockControls = new StockControl;
        if(strcmp($request->type,StockControl::TYPE_IN)==0) {
            $stockControls = StockControl::where('type', StockControl::TYPE_IN)->orderBy('id', 'desc')->get();
        } else if(strcmp($request->type,StockControl::TYPE_OUT)==0) {
            $stockControls = StockControl::where('type', StockControl::TYPE_OUT )->orderBy('id', 'desc')->get();
        } else {
            $stockControls = StockControl::orderBy('id', 'desc')->get();
        }
        return view('stockHistory')->with('stockControls',$stockControls);
    }

    public function destroy($id) {
       $stockControl = StockControl::findOrFail($id);
       $stockControl->delete();
    }

    public function __construct() {
        $this->middleware('auth');
        $stockControl = new StockControl;
    }
}
