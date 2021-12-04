<?php

namespace App\Http\Controllers;

use App\Events\RoomGameStart;
use App\Events\RoomMessageSent;
use App\Models\Room;
use App\Models\Word;
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
        RoomMessageSent::dispatch($room, false);
        //broadcast(new RoomMessageSent($room))->toOthers();

        // return view('Room', ['room' => $room, 'roomId' => $id, 'rooms'=>$room::all()]);
        return $room;
    }

    public function store(Request $request){
         $this->validate($request, [
             'title'=>'required',
         ]);


        // $this->validate($request, [
        //     'title'=>'required',
        // ]);

        
        $room = new Room();
        $room->title = $request->title;
        $room->isGame = false;
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

    public function getRandomWord(){
        $randomWord = Word::inRandomOrder()->first();

        return $randomWord;
    }

    public function confirmWord(Request $request){
        $submitWord = $request->submitWord;
        $lastWord = $request->lastWord;
        $confirm = false;

        $firstLetterOfSubmitWord = mb_substr($submitWord, 0, 1,'SERVER_CHARSET');
        $lastLetterOfLastWord = mb_substr($lastWord, mb_strlen($lastWord)-1, 1);

        if($firstLetterOfSubmitWord == $lastLetterOfLastWord){
            $confirm = !Empty(Word::where('word', $submitWord));
        }

        dd($request->all());

        // mb_substr( 문자열 ,  시작 숫자,   길이 , 인코딩 = mb_internal_encoding()  )
        
        return $confirm;
    }

    public function gameStart($id){
        $room = Room::find($id);
        $room->isGame = true;
        $room->save();
        
        // $user = Auth::user();
        // $user->inRoom = $id;
        // $user->save();

        #이벤트를 발생
        RoomMessageSent::dispatch($room, true);

        // return view('Room', ['room' => $room, 'roomId' => $id, 'rooms'=>$room::all()]);
        return $room;
    }    


}
