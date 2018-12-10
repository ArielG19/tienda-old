<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;

class UserController extends Controller
{
    public function profile()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order,$key){
            $order->cart =unserialize($order->cart);
            return $order;
        });
      //return view('profile',['orders'=>$orders]);
       return view('profile',array('user'=> Auth::user() ),['orders'=>$orders]);
     
    }

    public function update_avatar(Request $request)
   {
       $orders = Auth::user()->orders;
        $orders->transform(function($order,$key){
            $order->cart =unserialize($order->cart);
            return $order;
        });
     if($request->hasFile('avatar'))
     {
       $avatar= $request->file('avatar');
       $filename= time(). '.'. $avatar->getClientOriginalExtension();
       Image::make($avatar)->resize(300,300)->save(public_path('uploads/avatars/'.$filename));

       $user=Auth::user();
       $user->avatar =$filename;
       $user->save();
     }
     return view('profile', array('user'=> Auth::user() ),['orders'=>$orders]);
   }
    
    
}
