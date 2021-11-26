<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" async defer></script>
</head>
<body>
    <div id="app">
    
    <create-room></create-room>

    {{-- <room-list v-bind:roomList="{{ $roomList }}"></room-list> --}}

        {{-- <room-list :rooms="{{ $rooms }}" ></room-list> --}}
    <div>
  <the-main :rooms="{{ $rooms }}" :current-user="{{ Auth::user()->id }}"></the-main>
</div>
    

<div class="flex-1 h-full">
    <chat-component :current-user="{{ Auth::user()->id }}" :room-id="0"></chat-component>
</div>
</div>

</body>
</html>


{{-- <create-room/> --}}

{{-- @include('modal.createRoom')

<a href="#" class="btn btn-success" data-toggle="modal" data-target="#createModal">
    <span style="color:white">{{ __('방 만들기') }}</span> 
</a> --}}