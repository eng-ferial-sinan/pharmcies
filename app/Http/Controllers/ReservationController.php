<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $reservation = Reservation::all();
        return view('admin.reservation.index')->with('reservations',$reservation);
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

    public function setStatus(Request $request)
    {
        $reservation =Reservation::find($request->Reservation_id);
        $reservation->status_id = $request->status_id ;
        $reservation->save() ;
        $reservation =$reservation->fresh();
        return $reservation->status->name;
    }
    public function setUser(Request $request)
    {
        $reservation =Reservation::find($request->Reservation_id);
        $reservation->driver_id = $request->user_id ;
        $reservation->status_id = 3 ;
        $reservation->save() ;
        $reservation =$reservation->fresh();
        $data['user']=$reservation->driver->name;
        $data['status']=$reservation->status->name;
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($reservation)
    {
        $reservation = Reservation::find($reservation);
        return view('admin.reservation.show')->with('reservation',$reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation =  Reservation::find($id);
        $reservation->delete();
    return back()-> with('success','تم حذف  '.$reservation->name.'');
    }
}
