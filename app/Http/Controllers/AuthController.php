<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\cities;
use App\Models\seats;
use App\Models\trips;
use App\Models\bookings;
use Auth;
class AuthController extends Controller
{
   public function register(Request $request){
            $fields=$request->validate([
                'name'=>'required|string',
                'email'=>'required|string|unique:users,email',
                'password'=>'required|string|confirmed'
            ]);
            $user=User::create([
                'name'=>$fields['name'],
                'email'=>$fields['email'],
                'password'=>bcrypt($fields['password'])
            ]);

            $token=$user->createToken('myapptoken')->plainTextToken;
            $response=[
                'user'=>$user,
                'token'=>$token
            ];
            return response($response,201);
    }
    public function login(Request $request){
        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required'
        ]);
        $user=User::where(['email'=>$fields['email']])->first();
        
        if(!$user || !Hash::check($fields['password'],$user->password)){
           return response([
               'message'=>'Bad creds',
           ],401);
        }

        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
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
                            $available_seats=seats::all();
                        }else{               
                            $i=0;
                            foreach($booking_Data as $seats){
                            $booked_seats_ids[]=$booking_Data[$i]->seats->id;
                        $i++;
                            }
                            // print_r($booked_seats_ids);die;
                        $available_seats=seats::whereNotIn('id', $booked_seats_ids)->get();  
                        }
                        // print_r($available_seats);die;
                    }
    
            }   
            $response=[
                'message'=>'success',
                'status_code'=>200,
                'available_seats'=>$available_seats           
            ];
            return response($response,201);        
         }
         public function booking_seat(Request $request){
            $fields=$request->validate([
                'from'=>'required',
                'to'=>'required',
                'seat_id'=>'required'
            ]);

            
            $data=$request->all();
            $trips_Data=trips::where(['from'=>$fields['from'],'to'=>$fields['to']])->first();
            if(empty($trips_Data)){                
                $response=[
                    'message'=>'This trip not available now, please choose another direction',
                    'status_code'=>401,
                ];
                return response($response,401);
            }
            $available_seats=bookings::where(['trip_id'=>$trips_Data->id,'seat_id'=>$data['seat_id']])->count();
            if($available_seats==1){
               
                $response=[
                    'message'=>'Seat # not available for this trip, please choose another seat',
                    'status_code'=>401,
                ];
                return response($response,401);
            }
            $booking=new bookings();
            $booking->trip_id=$trips_Data->id;
            $booking->seat_id=$data['seat_id'];
            $booking->user_id=Auth::user()->id;
            $booking->save();
            $response=[
                'message'=>'success',
                'data'=>$booking,
                'status_code'=>200
            ];
            return response($response,201);
         }
        public function logout(Request $request){
            auth()->user()->tokens()->delete();
            return [
                'message'=>'logged out'
            ];
        }
}
