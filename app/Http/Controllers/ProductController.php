<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index', [
            'products' => product::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
    
        return view('product.show', [

            'products' => (new Product())->findOrFail($product_id)

        ]);
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('product.edit', [
            'products' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductRequest  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       
    
            $validated = $request->validate([
                'size' => 'required',
                'price'=> 'required',
                'description'=> 'required',
                'image'=> 'required',
                'is_active'=> 'required',
            ]);
    
    
            $product->update($validated);
    
    
            // set the success message to the session
    
            session()->flash('success', 'Product Updated Successfully');
    
    
    
            return redirect()->route('products.index');
    
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();

        //Pass success message to the session
       session()->flash('success','Product '. $product->typeofpizza->name . ' has been deleted successfully');

       //redirect back to index.user page
    return redirect()->route('products.index');
    }
}
