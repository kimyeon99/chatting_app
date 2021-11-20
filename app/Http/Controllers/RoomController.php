<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //방 만들기
    public function store(Request $request){
        $validate = $request->validate([
            'title'=>'required | min:2',
        ]);
    
        $room = Room::create($validate);

    
        // return response()->json ([
        //         'room' => $room
        //     ], 201);

        return $room;
    }
}
