<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    public function getMessages(Request $request)
    {
        $myId     = $request->myId;
        $friendId = $request->friendId;

        $messages = Message::where(

            function($query) use ($myId, $friendId){
                $query->where([
                    'from' => $myId,
                    'to'   => $friendId
                ]);
            }

        )->orWhere(
           
            function($query) use ($myId, $friendId){
                $query->where([
                    'from' => $friendId,
                    'to'   => $myId
                ]);
            }
                
        )->with('user')->get()->toArray();


        return response()->json(['messages'=>$messages], Response::HTTP_OK);
    }
}
