<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::where(function($query){
            $query->where('from', request('from'));
            $query->where('to', request('to'));
        })->orWhere(function($query){
            $query->where('from', request('to'));
            $query->where('to', request('from'));
        })->get();

        return response()->json ([
            // load: from 이름과 to 이름 가져온다.
            // with가 아니라 load인 점 주의
            'messages' => $messages->load('from', 'to')
        ], 200);
    }

    public function store(){
    $validate = request()->validate([
        'text'=>'required',
        'to'=>'required',
        'from'=>'required',
    ]);
    $message = Message::create($validate);

    return response()->json ([
            'message' => $message->load('from')
        ], 201);
    }


}
