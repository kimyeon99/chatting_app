<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>

    <div id="app">
        <create-room></create-room>
        
        <div style="position: relative;">
            <the-main :rooms="{{ $rooms }}" :current-user="{{ Auth::user()->id }}"></the-main>

            <!--프로필-->
            <div
                        class="bg-white my-12 pb-6 w-full justify-center items-center overflow-hidden md:max-w-sm rounded-lg shadow-sm mx-auto"
                        style="position: absolute; right: -310px; top: 2px;">

                        <div class="relative h-40">
                            <img
                                class="absolute h-full w-full object-cover">
                        </div>

                        <div
                            class="relative shadow mx-auto h-24 w-24 -my-12 border-white rounded-full overflow-hidden border-4">
                            <img src="{{ Auth::user()->profileImagePath() }}" class="object-cover w-full h-full">
                        </div>

                        <div class="mt-16">
                            <h1 class="text-lg text-center font-semibold">
                                {{ Auth::user()->name }}
                            </h1>
                        </div>
                    </div>
            <!--프로필-->
        </div>
    


    </div>

</body>
</html>


{{-- <create-room/> --}}

{{-- @include('modal.createRoom')

<a href="#" class="btn btn-success" data-toggle="modal" data-target="#createModal">
    <span style="color:white">{{ __('방 만들기') }}</span> 
</a> --}}