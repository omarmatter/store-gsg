<?php

namespace App\Http\Controllers\admin;

use App\Models\product;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Scopse\activestutasscop;
use Illuminate\Support\Facades\Gate;
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
      $this->authorize('viewAny');
        // if(!Gate::allows('product.create')){
        // abort(401);
        // }
        $products =product::active()->     //withoutGlobalScopes([new activestutasscop])
        join('categories', 'categories.id', '=', 'products.category_id')
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
        $this->authorize('create');

        $categories = category::pluck('name','id');
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

        $this->authorize('create');
        $request->validate(Product::validateRules());

     $request->merge([
         'slug'=> Str::slug($request->name)
     ]);
        $product = Product::create($request->all());

        return redirect()->route('product.index')
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
    public function trash(){

$products = product::onlyTrashed()->paginate(10);
return view('admin.product.trash',compact('products'));


    }
    public function restore($id =null){
  if($id){
        $product =product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('product.index')
            ->with('success', "Product ($product->name) restore.");
  }else{
    $product =product::onlyTrashed();
    $product->restore();
    return redirect()->route('product.index')
        ->with('success', "Product  restore all.");
  }
    }
    public function ForceDelete($id =null){

        if($id){
            $product=product::onlyTrashed()->findOrFail($id);
            $product->forceDelete();
            return redirect()->route('product.index')
            ->with('success', "Product ($product->name) force.");
        }else{

            $product=product::onlyTrashed();
            $product->forceDelete();
            return redirect()->route('product.index')
            ->with('success', "Product  force.");
        }
    }
}
