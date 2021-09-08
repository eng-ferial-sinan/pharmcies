<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\order;
use App\Models\detail;
use App\Models\Pharmacy;
use App\Models\status;
use App\Models\visit;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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
    public function index(Request $request)
    {
        $status=status::pluck('name','id')->all();
        $pharmacies=Pharmacy::pluck('name','id')->all();

        $filter = $request->all() ;
        $pharmacy_info= null ; 
        $items= detail::orderBy('medicine_id','desc') ;
        
        if(isset($filter['formdate'])) 
              $items=$items->whereDate('created_at','>=',$filter['formdate'] ) ;

        if(isset($filter['todate'])) 
              $items=$items->whereDate('created_at','<=',$filter['todate'] ) ;

        if(isset($filter['pharmacy_id'])) 
        {
              $order_id=order::where('pharmacy_id',$filter['pharmacy_id'])->pluck('id')->all();
              $items=$items->whereIn('order_id',$order_id) ;
              $pharmacy_info=Pharmacy::find($filter['pharmacy_id']) ;
        }
        if(isset($filter['status_id'])) 
        {     if($filter['status_id'][0] != null)
               $order_id=order::whereIn('status_id',$filter['status_id'])->pluck('id')->all();
               $items=$items->whereIn('order_id',$order_id) ;
        }
        
        $items=$items->select([
            DB::raw('SUM(price) as price'),
            DB::raw('SUM(sum) as sum'),
            DB::raw('SUM(count) as count'),
            DB::raw('medicine_id')
        ])->groupBy('medicine_id');  
        
        $total_count=$items->sum('count'); 
        $total_price=$items->sum('price'); 
        $total_sum=$items->sum('sum'); 
        $items=$items->get();

      return view('admin.reports.pharmacy')->with('pharmacies',$pharmacies)->with('items',$items)
      ->with('status',$status)->with('filter',$filter)->with('pharmacy_info',$pharmacy_info)
      ->with('total_count',$total_count)->with('total_price',$total_price)->with('total_sum',$total_sum);
    }

    public function representativeIndex(Request $request)
    {

         $users= User::where("user_type",'مندوب')->orderBy('id','asc')->pluck('name','id')->all();
        
         $filter = $request->all() ;
        $user_info= null ; 
        $items= visit::orderBy('created_at','desc') ;
        
        if(isset($filter['fromdate'])) 
              $items=$items->whereDate('created_at','>=',$filter['fromdate'] ) ;

        if(isset($filter['todate'])) 
              $items=$items->whereDate('created_at','<=',$filter['todate'] ) ;

        if(isset($filter['user_id'])) 
        {
              $items=$items->where('user_id','=',$filter['user_id'] ) ;
              $user_info=User::find($filter['user_id']) ;
        }
        
        $total_count=$items->count(); 

        $items=$items->get();
         return view('admin.reports.representative')->with('users',$users)
         ->with('items',$items)
         ->with('filter',$filter)->with('user_info',$user_info)->with('total_count',$total_count);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
    }
}
