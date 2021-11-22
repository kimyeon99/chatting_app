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
        // $user = Auth::user();
        // $user->inRoom = $id;
        // $user->save();

        #이벤트를 발생
        //RoomMessageSent::dispatch($id);
        broadcast(new RoomMessageSent($room))->toOthers();


        return view('Room', ['room' => $room, 'roomId' => $id]);
    }

    public function store(Request $request){
         $validate = $this->validate($request, [
             'title'=>'required',
         ]);


        // $this->validate($request, [
        //     'title'=>'required',
        // ]);

        $room = new Room();
        $room->title = $request->title;
        $room->save();

        $roomId = $room->id;

        // $user = Auth::user();
        // $user->inRoom = $room->id;
        // $user->isHost = true;
    
        // return response()->json ([
        //         'room' => $room
        //     ], 201);

        // return redirect('components.Room');
        return $roomId;
        // return redirect()->route('room.show', ['id' => $room->id]);
    }

    public function leaveRoom($id){
        return view('dashboard');
    }

    public function destroy(){

    }
}
