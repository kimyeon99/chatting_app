<?php

namespace App\Http\Controllers;

use App\Events\RoomGameStart;
use App\Events\RoomMessageSent;
use App\Models\Room;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use PDO;

use function GuzzleHttp\Promise\queue;
use function PHPUnit\Framework\isEmpty;

class RoomController extends Controller
{
    public function index()
    {
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
        $this->setUserInRoom($id);

        #이벤트를 발생
        RoomMessageSent::dispatch($room, false, null, 0, 0);
        //broadcast(new RoomMessageSent($room))->toOthers();

        // return view('Room', ['room' => $room, 'roomId' => $id, 'rooms'=>$room::all()]);
        return $room;
    }

    public function setUserInRoom($id)
    {
        $user = User::find(Auth::user()->id);
        $user->inRoom = $id;
        $user->save();
    }

    public function getPlayerList($id)
    {
        $room = Room::find($id)->with('users')->get();
        dd($room);
        return $room;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
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

    public function leaveRoom()
    {
        dd('1');
        return view('dashboard');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();
        $room->save();
        return redirect()->route('room.leaveRoom', ['id' => $id]);
    }

    public function getRandomWord()
    {
        $randomWord = Word::inRandomOrder()->first();

        return $randomWord;
    }

    public function confirmWords(Request $request)
    {

        $lastWord = $request->lastWord;
        $submitWord = $request->submitWord;
        $currentUser = Auth::user()->id;
        $roomId = $request->roomId;

        $confirm = 0;

        $lastLetterOfLastWord = mb_substr($lastWord, mb_strlen($lastWord, 'utf-8') - 1, 1);
        $firstLetterOfSubmitWord = mb_substr($submitWord, 0, 1);
        //dd($lastLetterOfLastWord, $lastWord);

        if ($firstLetterOfSubmitWord == $lastLetterOfLastWord) {
            $check = Word::where('word', $submitWord)->get();

            if (sizeof($check)) {
                $confirm = 1;
                $room = Room::find($roomId);
                $room->round -= 1;
                $room->save();

                $player = $request->player;

                //dd('들어ㅗㅇ랑');
                if ($room->round == 0) {
                    return $this->gameEnd($roomId);
                }

                RoomMessageSent::dispatch($room, true, $check, $confirm, $player);
            }
        }

        // dd($lastLetterOfLastWord, $firstLetterOfSubmitWord, $confirm);

        // mb_substr( 문자열 ,  시작 숫자,   길이 , 인코딩 = mb_internal_encoding()  )

        return ['confirm' => $confirm, 'currentUser' => $currentUser];
    }

    public function gameStart($id)
    {
        $room = Room::find($id);
        $room->isGame = true;
        $room->save();

        // $user = Auth::user();
        // $user->inRoom = $id;
        // $user->save();

        $randomWord = $this->getRandomWord();

        #이벤트를 발생
        RoomMessageSent::dispatch($room, true, $randomWord, 0, 0);

        // return view('Room', ['room' => $room, 'roomId' => $id, 'rooms'=>$room::all()]);
        return $room;
    }

    public function gameEnd($id)
    {
        $room = Room::find($id);
        $room->isGame = false;
        $room->round = 5;
        $room->save();

        RoomMessageSent::dispatch($room, false, null, 2, 0);
    }

    public function getProfile($id)
    {
        $user = User::find($id);
        return $user->profileImagePath();
    }

    public function setRound($id)
    {
        $room = Room::find($id);
        $room->round = 5;
        $room->save();

        return $room;
    }

    public function getScore($id)
    {
        if ($id != 0) {
            $player1 = User::where('inRoom', $id)->get();
            $player2 = User::where('inRoom', $id)->get();
            $player3 = User::where('inRoom', $id)->get();
        }
    }
}
