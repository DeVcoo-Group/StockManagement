<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use Response;
class ProductController extends Controller
{
    protected $product;
    
    public function index()
    {
        return view('productTable')->with('products',Product::all());
    }

    public function create()
    {
        $product = new product;
        return view('productForm')->with('product',$product);
    }

    public function store(Request $request)
    {
        $product = new Product;
        if($request->id != null) {
            $product->id = $request->id;    
            $product= Product::find($request->id);
        }        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return $this->index();
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('productForm')->with('product',$product);
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
       $product = Product::findOrFail($id);
       $product->delete();
       return view('productTable')->with('products',Product::all());
    }
    
    public function search(Request $request) {
        $name = $request->term;
        if(empty($name)) {
            $products = Product::all()->take(20);
        } else if(strlen(trim($name))==4) {
            $products = Product::where('name', 'like', $name.'%')->take(15)->get();
        } else {
             $products = Product::where('name', 'like', $name.'%')->get();
        }
        return Response::json($products);
    }
    
    public function __construct()
    {
        $product = new Product;
    }
}
