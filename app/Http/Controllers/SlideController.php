<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::all();
      return view('admin.slide.index')->with('slides',$slide);
  
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'sort' => 'required',
        ]);
        $slide =new Slide;
        $slide->sort=$request->sort;

        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "slide_" .time().'.jpg';
            $imagename->move(public_path('categories/'), $fileNameToStore);
            $slide->image='/categories/'.$fileNameToStore;
        }
        $slide->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');
  

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $this->validate($request, [
            'sort' => 'required',
        ]);
        $slide = Slide::find($id);
        $slide->sort=$request->sort;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "slide_" .time().'.jpg';
            $imagename->move(public_path('categories/'), $fileNameToStore);
            $slide->image='/categories/'.$fileNameToStore;
        }
        $slide->save();
        return  back()-> with('success','تم حفظ التعديلات ');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $slide =  Slide::find($id);
        $slide->delete();
    return back()-> with('success','تم حذف  '.$slide->name.'');
 
    }
}
