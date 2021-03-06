<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Inventory;
class InventoryController extends Controller
{
   protected $inventory;

    public function index()
    {
        $inventories = Inventory::all();
        foreach ($inventories as $value) {
            $qty = 0;
            foreach ($value->inventoryPrice as $value1) {
                $qty = $qty + $value1->qty;
            }
            $value->qty = $qty;
        }
        return view('inventoryTable')->with('inventorys',$inventories);
    }

    public function create()
    {
        $inventory = new inventory;
        return view('inventoryForm')->with('inventory',$inventory);
    }

    public function store(Request $request)
    {
        $inventory = new Inventory;
        if($request->id != null) {
            $inventory->id = $request->id;
            $inventory= Inventory::find($request->id);
        }
        $inventory->name = $request->name;
        $inventory->save();
        return $this->index();
    }

    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventoryWithPriceTable')->with('inventory',$inventory);
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
       $inventory = Inventory::findOrFail($id);
       $inventory->delete();
       return view('inventoryTable')->with('inventorys',Inventory::all());
    }

    public function __construct()
    {
        $inventory = new Inventory;
    }

}
