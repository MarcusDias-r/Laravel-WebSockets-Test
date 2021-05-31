<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function getAll()
    {
        $myId  = Auth::user()->id;
        $users = User::where('id', '!=', $myId)->get()->toArray();
       
        return response()->json($users);
    }




    public function defineOnlineSessionUsers(){
        
        $myId = Auth::user()->id;
        $friends_id_list = User::select('id')->where('id', '!=', $myId)->get()->toArray();;
        $friends_array   = array();

        foreach($friends_id_list as $f){
      
            if(Cache::has('user-is-online-'.$f['id'])){
                
                $friends_array[] = $f['id'];
                
            }else{

                $key  = array_search($f['id'], $friends_array);

                if($key){
                    unset($friends_array[$key]);
                }
            }
           
        }
        return response()->json($friends_array);
    }
}
