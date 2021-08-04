<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name',
        ])
        ->paginate(15);

        return view('admin.product.index' ,compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = category::all();
        return view('admin.product.create', [
            'categories' => $categories,
            'product' => new Product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::validateRules());


        $product = Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', "Product ($product->name) created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);


        return view('admin.product.edit', [
            'product' => $product,
            'categories' => category::withTrashed()->pluck('name','id')
        ]);
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
        $product = Product::findOrFail($id);
        if($request->hasFile('image')){
        $file = $request->file('image');
        $image_path= $file->store('/', 'uplode');
        $request->merge([
'image_path' => 'uplode/'.$image_path
        ]);
        }
        $product->update($request->all());


        return redirect()->route('product.index')
            ->with('success', "Product ($product->name) updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        //   Storage::disk('uplode')->delete($product->image_pathe);
        unlink(public_path($product->image_path));

        return redirect()->route('product.index')
            ->with('success', "Product ($product->name) deleted.");
    }
}
