<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Termwind\render;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return Inertia::render('products/Index', compact('products'));
    }

    public function create(){
        return Inertia::render('products/Create', []);
    }

    public function store(Request $request ) {
        $data = $request -> validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',

        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('message','Product added successfully');
    }

    public function edit(Product $product){
        return Inertia::render('products/Edit', compact('product'));
    }

}
