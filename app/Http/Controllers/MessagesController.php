<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Events\SendMessage\SendMessage as SendMessageSendMessage;
use App\Models\Message;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{

    public function getMessages(Request $request)
    {   
       
        $myId     = Auth::user()->id;
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

    public function sendMessage(Request $request)
    {
        $myId     = Auth::user()->id;

        $message = new Message();
        $message->from    = $myId;
        $message->to      = $request->to;
        $message->content = $request->content;
        $message->save();

        Event::dispatch(new SendMessage($message, $request->to));
    }


}
