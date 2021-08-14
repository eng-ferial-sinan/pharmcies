<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = category::all();
      return view('admin.category.index')->with('categorys',$category);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category =new category;
        // return view('admin.category.form')->with('item',$category);
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

        $category =new category;
        $category->name=$request->name;
        $category->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = category::find($id);
        $category->name=$request->name;
        $category->save();

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
        $category =  category::find($id);
        $category->delete();
    return back()-> with('success','تم حذف  '.$category->name.'');
    }
}
