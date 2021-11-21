<?php

namespace App\Http\Controllers;

use App\Events\RoomMessageSent;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::find($id);
        $user = Auth::user();
        $user->inRoom = $id;

        #이벤트를 발생
        RoomMessageSent::dispatch($room);

        return view('Room', ['room' => $room]);
    }

    public function store(Request $request){
        // $validate = $this->validate($request, [
        //     'title'=>'required',
        // ]);
    
        // $room = Room::create($validate);

        $this->validate($request, [
            'title'=>'required',
        ]);

        $room = new Room();
        $room->title = $request->title;
        $room->save();

        $user = Auth::user();
        $user->inRoom = $room->id;
        $user->isHost = true;
    
        // return response()->json ([
        //         'room' => $room
        //     ], 201);

        // return redirect('components.Room');
        // return redirect()->back();
        return redirect()->route('room.show', ['id' => $room->id]);
    }

    public function leaveRoom(){

    }

    public function destroy(){

    }
}
