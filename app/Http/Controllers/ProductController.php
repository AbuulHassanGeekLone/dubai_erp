<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category')
            ->get();
        $data['title'] = 'Products';

        return view('product.index', compact('products'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['title'] = 'Products';

        return view('product.create', $data, compact('categories'));
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
            'category' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        if ($request->hasFile('avatar')) {

            $temp_img = $request->file('avatar');
            if ($temp_img->isValid()) {
                $extension = $temp_img->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $img_path = public_path($filename);

                \Image::make($temp_img)->resize(100, 100)->save($img_path);
                $product->picture = $filename;
            }
        }

        try {
            $product->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Product name already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        Session::flash('message', 'Product Added Successfully');
        Session::flash('class', 'success');

        if ($request->num == 1) {

            return redirect()->action('ProductController@index');
        } else {

            return redirect()->action('ProductController@create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function productdelete($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();

        return 'true';
    }

    public function productedit($id)
    {
        $product = Product::find($id);

        if (!$product) return abort(404);

        $categorypre = Category::find($product->category_id);
        $categories = Category::orderBy('name', 'ASC')->get();

        $data['title'] = 'product';

        return view('product.edit', compact('product', 'categorypre', 'categories'), $data);
    }

    public function productupdate($id, Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'category' => 'required'
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        if ($request->hasFile('avatar')) {
            //                $temp_img = Input::file('design');
            $temp_img = $request->file('avatar');
            if ($temp_img->isValid()) {
                $extension = $temp_img->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $img_path = public_path($filename);
                //                    \Image::save($img_path);
                \Image::make($temp_img)->resize(100, 100)->save($img_path);
                $product->picture = $filename;
            }
        }

        try {
            $product->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'Product name already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        Session::flash('message', 'product Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('ProductController@productedit', ['id' => $product->id]);
    }
}
