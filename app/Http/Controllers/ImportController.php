<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Import;
use App\Inventory;
use App\Product;
use App\Supplier;
use Carbon\Carbon;
class ImportController extends Controller
{
    protected $import;
    
    public function index()
    {
        $import = new import;
        $import->product = new Product;
        $import->supplier = new Supplier;
        $import->date = Carbon::today()->format('Y/m/d');
        return view('importForm')->with('import',$import);
    }

    public function create()
    {
        $import = new import;
        $import->product = new Product;
        $import->supplier = new Supplier;
        return view('importForm')->with('import',$import);
    }

    public function store(Request $request)
    {
        $import = new Import;
        if($request->id != null) {
            $import->id = $request->id;    
            $import= Import::find($request->id);
        } 
        $import->date = $request->date;
        $import->price = $request->price;
        $import->qty = $request->qty;
        $import->refpro = $request->refpro;
        $import->refsup = $request->refsup;
        
        $inventory = Inventory::where([
            ['refpro',$request->refpro]])->get();
        if(count($inventory) == 0) {
            $inventory = new Inventory;
            $inventory->qty = $import->qty;
            $inventory->refpro = $import->refpro;
        } else {
            $inventory = $inventory[0];
            $inventory->qty = $inventory->qty + $import->qty;
        }
        $inventory->save();
        $import->save();
        return $this->index();
    }

    public function show($id)
    {
        $import = Import::find($id);
        if(empty($import)) {
            abort(404);
        }
        return view('importForm')->with('import',$import);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    

    public function destroy($id)
    {
       $import = Import::findOrFail($id);
       $import->delete();
       return view('importTable')->with('imports',Import::all());
    }
    
    public function __construct()
    {
        $import = new Import;
    }
}
