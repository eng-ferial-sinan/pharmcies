<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\User;

class PharmacyController extends Controller
{
    //
     public function __construct(Request $request)
     {
        $this->middleware('auth');
     }
    public function index(Request $request)
    {
        
      if (! auth()->user()->hasPermission('Pharmacy-list')) {
			return redirect()->back()->with('error','ليس من صلاحياتك');
      }
        // $users = \App\Models\User::where('user_type','صيدلاني')->pluck('name', 'id')->toArray();
        // $filter = $request->all() ;

        $pharmacy = pharmacy::all();
        //       $user = \App\Models\User::where('user_type','صيدلاني')->orderBy('id','asc');

        // if(isset($filter['users_id']))
        // {     if($filter['users_id'][0] != null)
        //         $user=$user->whereIn('id',$filter['users_id'] ) ;
        // }
        // $user=$user->paginate(10);

      return view('admin.pharmacy.index')->with('pharmacies',$pharmacy);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pharmacy =new pharmacy;
        return view('admin.pharmacy.form')->with('item',$pharmacy);
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
            'phone' => 'required',
            'user_id' => 'required',
        ]);

        $pharmacy =new pharmacy;
        $pharmacy->name=$request->name;
        $pharmacy->phone=$request->phone;
        $pharmacy->lat=$request->lat;
        $pharmacy->lng=$request->lng;
        $pharmacy->user_id=$request->user_id;
        $pharmacy->address=$request->address;
        if($request->hasFile('image')){
            $imagename = $request->file('image');
            $fileNameToStore= "pharmacy_" .time().'.jpg';
            $imagename->move(public_path('pharmacies/'), $fileNameToStore);
            $pharmacy->image='/pharmacies/'.$fileNameToStore;            
             } 
        $pharmacy->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(pharmacy $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(pharmacy $pharmacy)
    {
        // $pharmacy =pharmacy::find($pharmacy->id);
        return view('admin.pharmacy.form')->with('item',$pharmacy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $pharmacy = pharmacy::find($id);
        $pharmacy->name=$request->name;
        $pharmacy->phone=$request->phone;
        $pharmacy->lat=$request->lat;
        $pharmacy->lng=$request->lng;
        $pharmacy->user_id=$request->user_id;
        $pharmacy->address=$request->address;
        if($request->hasFile('image')){
            $imagename = $request->file('image');
            $fileNameToStore= "pharmacy_" .time().'.jpg';
            $imagename->move(public_path('pharmacies/'), $fileNameToStore);
            $pharmacy->image='/pharmacies/'.$fileNameToStore;            
             }  
        $pharmacy->save();

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
        $pharmacy =  pharmacy::find($id);
        $pharmacy->delete();
    return back()-> with('success','تم حذف  '.$pharmacy->name.'');
    }
}
