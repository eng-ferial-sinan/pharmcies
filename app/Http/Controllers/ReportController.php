<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\order;
use App\Models\detail;
use App\Models\OrderProduct;
use App\Models\Pharmacy;
use App\Models\Product;
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
        $status=Status::pluck('name','id')->all();
        $products=Product::pluck('name','id')->all();

        $filter = $request->all() ;
        $pharmacy_info= null ; 
        $items= OrderProduct::orderBy('id','desc') ;
        
        if(isset($filter['formdate'])) 
              $items=$items->whereDate('created_at','>=',$filter['formdate'] ) ;

        if(isset($filter['todate'])) 
              $items=$items->whereDate('created_at','<=',$filter['todate'] ) ;

        
        if(isset($filter['status_id'])) 
        {     if($filter['status_id'][0] != null)
               $order_ids=Order::whereIn('status_id',$filter['status_id'])->pluck('id');
               $items=$items->whereIn('order_id',$order_ids) ;
        }
        $total_count=$items->sum('count'); 
        $total_price=$items->sum('price'); 
        $total_sum=$items->sum('sum'); 
        $items=$items->get();

      return view('admin.reports.orders')->with('items',$items)
      ->with('status',$status)->with('filter',$filter)
      ->with('total_count',$total_count)->with('total_price',$total_price)->with('total_sum',$total_sum);
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
