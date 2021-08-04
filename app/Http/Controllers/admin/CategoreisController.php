<?php

namespace App\Http\Controllers\admin;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoreisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
 $this->middleware(['auth','verified']);
    }
    public function index()
    {
        $entries = category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->where('categories.status', '=', 'active')
            ->orderBy('categories.created_at', 'DESC')
            ->orderBy('categories.name', 'ASC')
            // ->withTrashed()
            ->get();
            return view('admin.categorey.index', [
                'categories' => $entries,
                'title' => 'Categories List'
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();

        $category = new category();
        return view('admin.categorey.create' ,compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3|unique:categories',
            'parent_id' => 'required|int|exists:categories,id',
            'description' => 'nullable|min:5',
            'status' => 'required|in:active,draft',
            'image' => 'image|max:512000|dimensions:min_width=300,min_height=300',
        ]);
      $category = new Category([
            'name' => $request->post('name'),
            'slug' => Str::slug($request->post('name')),
            'parent_id' => $request->post('parent_id'),
            'description' => $request->post('description'),
            'status' => $request->post('status', 'active'),
        ]);
        $category->save();

        // PRG
        return redirect()->route('categories.index')
            ->with('success', 'Category created');
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
        $parents = Category::all();
        $category = category::findOrFail($id);
        return view('admin.categorey.edit', compact('category','parents'));
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
        $category = Category::find($id);

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $category->update($request->all());

    return redirect()->route('categories.index')
    ->with('success', 'Category updated');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::destroy($id);
        return redirect()->route('categories.index');
    }
}
