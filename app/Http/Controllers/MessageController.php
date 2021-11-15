<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        Message::where(function($query){
            $query->where('from', request('from'));
            $query->where('to', request('to'));
        })->orWhere(function($query){
            $query->where('from', request('from'));
            $query->where('to', request('to'));
        })->latest()->get();

        return response()->json([
            'message' => $messages,
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
            'message' => $message,
        ], 201);
    }


}
