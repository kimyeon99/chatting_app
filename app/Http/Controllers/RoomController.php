<?php

namespace App\Http\Controllers;

use App\Events\RoomMessageSent;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

use function GuzzleHttp\Promise\queue;

class RoomController extends Controller
{
    public function index(){
        $roomList = Room::all();
        // dd($roomList);
        return $roomList;
    }
    
    public function show($id)
    {
        $room = Room::find($id);
        // $user = Auth::user();
        // $user->inRoom = $id;
        // $user->save();

        #이벤트를 발생
        //RoomMessageSent::dispatch($id);
        broadcast(new RoomMessageSent($room))->toOthers();

        // return view('Room', ['room' => $room, 'roomId' => $id, 'rooms'=>$room::all()]);
        return $room;
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

    
        // return response()->json ([
        //         'room' => $room
        //     ], 201);

        // return redirect('components.Room');
         return $room;
        //  return redirect()->route('room.show', ['id' => $room->id]);
    }

    public function leaveRoom(){
        dd('1');
        return view('dashboard');
    }

    public function destroy($id){
        $room = Room::find($id);
        $room->delete();
        $room->save();
        return redirect()->route('room.leaveRoom', ['id' => $id]);
    }
}
