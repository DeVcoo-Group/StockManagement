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
    public function importIndex(Request $request = null, $id = null) {
        $import = new StockControl;
        if(empty($id)) {
            $import->product = new Product;
            $import->supplier = new Supplier;
            $import->date = Carbon::today();
        } else {
            $import = StockControl::whereRaw('type = '. StockControl::TYPE_IMPORT . ' and id = ?', array($id))->first();
            if(empty($import)) {
                abort(404);
            }
        }
        return view('importForm')->with('import',$import);;
    }
    
    public function exportIndex(Request $request = null, $id = null) {
        if(empty($id)) {
            $export = new StockControl;
            $export->product = new Product;
            $export->supplier = new Supplier;
            $export->date = Carbon::today();
        } else {
            $export = StockControl::whereRaw('type = '. StockControl::TYPE_EXPORT . ' and id = ?', array($id))->first();
            if(empty($export)) {
                abort(404);
            }
        }
        return view('exportForm')->with('export',$export);
    }
    
    public function importShow($id)
    {
        $import = StockControl::find($id);
        if(empty($import)) {
            abort(404);
        }
        return view('importForm')->with('import',$import);
    }
    
    public function exportShow($id)
    {
        $export = StockControl::find($id);
        if(empty($export)) {
            abort(404);
        }
        return view('importForm')->with('import',$export);
    }
    
    public function import(Request $request) {
        $stockControl = new StockControl;
        $stockControl->assignRequest($request);
        $stockControl->type = StockControl::TYPE_IMPORT;
        
        $inventory = Inventory::where([['refpro',$request->refpro]])->get();
        if(count($inventory) == 0) {
            $inventory = new Inventory;
            $inventory->qty = $stockControl->qty;
            $inventory->refpro = $stockControl->refpro;
        } else {
            $inventory = $inventory[0];
            $inventory->qty = $inventory->qty + $stockControl->qty;
        }
        $inventory->save();
        $stockControl->save();
        return view('importForm')->with('import',$stockControl);
    }
    public function export(Request $request) {
        $stockControl = new StockControl;
        $stockControl->assignRequest($request);
        $stockControl->type = StockControl::TYPE_EXPORT;
        
        $inventory = Inventory::where([['refpro',$request->refpro]])->get();
        if(count($inventory) == 0) {
            abort(404);
        } else {
            $inventory = $inventory[0];
            if($inventory->qty > $stockControl->qty) {
                $inventory->qty = $inventory->qty - $stockControl->qty;    
            } else {
                abort(404);
            }
        }
        $inventory->save();
        $stockControl->save();
        return view('exportForm')->with('export',$stockControl);
    }
    
    public function returnExport(Request $request) {
        $stockControl = new StockControl;
        $stockControl->assignRequest($request);
        $stockControl->refreturn = $request->refreturn;
        $stockControl->type = StockControl::TYPE_RETURN_EXPORT;
        
        $stockForReturn = StockControl::findOne($request->refreturn);
        
        $inventory = Inventory::where([['refpro',$request->refpro]])->get();
        if(count($inventory) == 0 || empty($stockForReturn)) {
            abort(404);
        } else {
            $inventory = $inventory[0];
            if($stockForReturn->qty > $stockControl->qty) {
                $inventory->qty = $inventory->qty + $stockControl->qty;    
            } else {
                abort(404);
            }
        }
        $inventory->save();
        $stockControl->save();
    }
    
    public function returnImport(Request $request) {
        $importForReturn = StockControl::find($request->id);
        $stockReturn = new StockControl;
        $stockReturn->price = $importForReturn->price;
        $stockReturn->qty = $importForReturn->qty;
        $stockReturn->type = StockControl::TYPE_RETURN_IMPORT;
        $stockReturn->refpro = $importForReturn->refpro;
        $stockReturn->refsup = $importForReturn->refsup;
        $stockReturn->date = Carbon::now();
        $stockReturn->refreturn = $importForReturn->id;
        
        $inventory = Inventory::where([['refpro',$request->refpro]])->get()->first();
        if(empty($inventory) || empty($importForReturn)) {
            abort(404);
        } else {
            if($importForReturn->qty == $stockReturn->qty) {
                $inventory->qty = $inventory->qty - $stockReturn->qty;    
            } else {
                abort(404);
            }
        }
        $inventory->save();
        $stockReturn->save();
        $importForReturn->refreturn = $stockReturn->id;
        $importForReturn->save();
        return view('importForm')->with('import',$stockReturn);
    }
    
 /*   public function importReturnShow($id, $returnid) {
        
        // $table->increments('id');
        //     $table->date('date');
        //     $table->double('price');
        //     $table->integer('qty');
        //     $table->integer('type');
        //     $table->integer('refreturn')->nullable();
        //     $table->foreign('refreturn')->references('id')->on('stockcontrol');
        //     $table->integer('refpro')->unsigned();
        //     $table->foreign('refpro')->references('id')->on('product');
        //     $table->integer('refsup')->unsigned();
        //     $table->foreign('refsup')->references('id')->on('supplier');
        
        $import = StockControl::find($id);
        if(empty($export)) {
            abort(404);
        }
        $returnImport = new StockControl;
        $returnImport->refreturn = $import->id;
        $returnImport->price = $import->price;
        $returnImport->type = $import->type;
        $returnImport->qty = $import->qty;
        $returnImport->product = $import->product;
        $returnImport->supplier = $import->supplier;
        $returnImport->refpro = $import->refpro;
        $returnImport->refsup = $import->refsup;
        
        
    }*/
    
    public function findWhere(Request $request) {
        $stockControls = new StockControl;
        if(strcmp($request->type,StockControl::TYPE_IMPORT)==0) {
            $stockControls = StockControl::where('type', StockControl::TYPE_IMPORT)->orderBy('id', 'desc')->get();
        } else if(strcmp($request->type,StockControl::TYPE_RETURN_IMPORT)==0) {
            $stockControls = StockControl::where('type', StockControl::TYPE_RETURN_IMPORT )->orderBy('id', 'desc')->get();
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
        $stockControl = new StockControl;
    }
    
}
