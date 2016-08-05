<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Supplier;
use Response;
class SuppllierController extends Controller
{
    protected $supplier;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supplierTable')->with('suppliers',Supplier::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = new Supplier;
        return view('supplierForm')->with('supplier',$supplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier = new Supplier;
        if($request->id != null) {
            $supplier->id = $request->id;    
            $supplier= Supplier::find($request->id);
        }        
        $supplier->name = $request->name;
        $supplier->description = $request->description;
        $supplier->save();
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplierForm')->with('supplier',$supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $supplier = Supplier::findOrFail($id);
       $supplier->delete();
       return view('supplierTable')->with('suppliers',Supplier::all());
    }
    
    public function search(Request $request) {
        $name = $request->term;
        if(empty($name)) {
            $supplier = Supplier::all()->take(20);
        } else if(strlen(trim($name))==4) {
            $supplier = Supplier::where('name', 'like', $name.'%')->take(15)->get();
        } else {
             $supplier = Supplier::where('name', 'like', $name.'%')->get();
        }
        return Response::json($supplier);
    }
    
    public function __construct()
    {
        $supplier = new Supplier;
    }
}
