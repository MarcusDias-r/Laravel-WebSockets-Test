<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAll()
    {
        $myId  = Auth::user()->id;
        $users = User::where('id', '!=', $myId)->get()->toArray();
       
        return response()->json($users);
    }
}
