<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;
use App\Models\seats;
use App\Models\bookings;
use App\Models\trips;
use Validator;
use Auth;
use DB;
class BookingsController extends Controller
{

    public function index(){     
        $booking_Data=bookings::paginate(6)->withQueryString();
        return view('booking/index',compact('booking_Data'));
    }
    public function create(){
       $citiesData=cities::all();
       $seatsData=seats::all();
       return view('booking/create',compact('citiesData','seatsData'));
    }
    public function store(Request $request){
        $customMessages = [
            'from.required'=>'Trip from field is required',
            'to.required'=>'Trip to field is required',
            'seat_id.required'=>'Seat # field is required'
            ];
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'seat_id' => 'required',
        ],$customMessages);
        if ($validator->fails()) {
            return redirect()->route('booking')
                ->withErrors($validator)
                ->withInput();
        }
        $data=$request->all();
        $trips_Data=trips::where(['from'=>$data['from'],'to'=>$data['to']])->first();
        if(empty($trips_Data)){
            return redirect()->back()->withErrors(__('This trip not available now, please choose another direction'));

        }
        $available_seats=bookings::where(['trip_id'=>$trips_Data->id,'seat_id'=>$data['seat_id']])->count();
        if($available_seats==1){
            return redirect()->back()->withErrors(__('Seat # not available for this trip, please choose another seat'));

        }
        $booking=new bookings();
        $booking->trip_id=$trips_Data->id;
        $booking->seat_id=$data['seat_id'];
        $booking->user_id=Auth::user()->id;
        $booking->save();
        return redirect()->back()->with('message', __('Booking bus successfuly'));

     }
     public function available_seats(){
        $citiesData=cities::all();
        $available_seats=array();
        $booked_seats_ids=array();

        if( isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to']) ){
            $trips_Data=trips::where(['from'=>$_GET['from'],'to'=>$_GET['to']])->first();
                if(!empty($trips_Data)){
                    $trip_id=$trips_Data->id;
                
                    $booking_Data=bookings::with('seats')->where(['trip_id'=>$trip_id])->get();
                    if(count($booking_Data)==0){
                        //all seats available
                        $available_seats=seats::paginate(6)->withQueryString();
                    }else{               
                        $i=0;
                        foreach($booking_Data as $seats){
                        $booked_seats_ids[]=$booking_Data[$i]->seats->id;
                    $i++;
                        }
                        // print_r($booked_seats_ids);die;
                    $available_seats=seats::whereNotIn('id', $booked_seats_ids)->paginate(6)->withQueryString();;  
                    }
                    // print_r($available_seats);die;
                }

        }   
        return view('booking/available_seats',compact('citiesData','available_seats'));
     }
     
    
}
