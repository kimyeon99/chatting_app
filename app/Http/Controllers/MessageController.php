<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
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
    
    // 이벤트에서 Illuminate\Foundation\Events\Dispatchable trait를 사용하는 경우
    // 이벤트에서 정적 dispatch 메서드를 호출 할 수 있습니다. 
    // dispatch 메소드에 전달 된 모든 인수는 이벤트 생성자에 전달됩니다.
    MessageSent::dispatch($message);

    return response()->json ([
            'message' => $message->load('from')
        ], 201);
    }
}
