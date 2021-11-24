<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;

class ProductController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $categories=category::pluck('name','id')->all();
        $product = Product::all();
      return view('admin.product.index')->with('products',$product)
      ->with('categories',$categories);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product =new Product;
        return view('admin.product.form')->with('item',$product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $product =new Product;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->sort=$request->sort;
        $product->category_id=$request->category_id;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "product_" .time().'.jpg';
            $imagename->move(public_path('products/'), $fileNameToStore);
            $product->image='/Products/'.$fileNameToStore;
        }
        $product->save();
        
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product =Product::find($product->id);
        return view('admin.product.form')->with('item',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $product = Product::find($id);
        $product->name=$request->name;
        $product->price=$request->price;
        $product->sort=$request->sort;
        $product->category_id=$request->category_id;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "Product_" .time().'.jpg';
            $imagename->move(public_path('Products/'), $fileNameToStore);
            $product->image='/Products/'.$fileNameToStore;
        }
        $product->save();
        

        return  back()-> with('success','تم حفظ التعديلات ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  Product::find($id);
        $product->delete();
    return back()-> with('success','تم حذف  '.$product->name.'');
    }
}
