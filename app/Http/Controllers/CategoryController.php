<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Category::all();
      return view('admin.category.index')->with('categorys',$category);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'sort' => 'required',
        ]);

        $category =new category;
        $category->name=$request->name;
        $category->sort=$request->sort;
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
            'sort' => 'required',
        ]);

        $category = Category::find($id);
        $category->name=$request->name;
        $category->sort=$request->sort;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "category_" .time().'.jpg';
            $imagename->move(public_path('categories/'), $fileNameToStore);
            $category->image='/categories/'.$fileNameToStore;
        }
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
        $category =  Category::find($id);
        $category->delete();
    return back()-> with('success','تم حذف  '.$category->name.'');
    }
}
