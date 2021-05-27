<?php

namespace App\Http\Controllers;

use Response;
use Session;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Category';
        $categories = Category::all();

        return view('category.index', compact('categories'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $category = new Category();
        $category->name = $request->category;

        try {
            $category->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return Response::json(array(
                    'code' => 1062,
                    'message' => "Region already exists!"
                ), 400);
            }
        }

        $categories = Category::orderBy('name', 'ASC')->get();

        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        Session::flash('message', 'Category Added Successfully');
        Session::flash('class', 'success');

        return redirect()->action('CategoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function categorydelete($id)
    {
        $category = Category::where('id', $id)->first();
        $category->delete();

        return 'true';
    }

    public function categoryupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required | unique:App\Category,name',
        ]);
        $category = Category::where('id', $id)->first();
        $category->name = $request->name;
        $category->save();
        Session::flash('message', 'category Updated Successfully');
        Session::flash('class', 'success');

        return \redirect('category');
    }
}
