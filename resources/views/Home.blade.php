<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    
            <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel|Archivo+Black|Barlow">
    </head>
<body>

    <!-- component -->
    <div id="content" class="bg-center bg-cover bg-no-repeat h-screen items-center justify-center flex flex-col" style="background-image: url(&quot;https://res.cloudinary.com/moodgiver/image/upload/v1623360651/jean-philippe-delberghe-1400011-unsplash_a8qscz.jpg&quot;);">
        <div id="moka-w1wgf" class="items-center justify-center w-full p-8 flex flex-col">
            <div id="moka-ix3cs" class="bg-gray-400 items-center justify-center md:w-1/2 w-full shadow-md p-5 h-auto rounded-lg blur-3 bg-opacity-50 flex flex-col col-span-12">
                <h4 class="w-48 border-t-4 border-solid border-red-500 h-20" id="moka-uuij0">
                </h4>
                <h4 class="text-orange-300    text-2xl" id="moka-8q3tt" style="font-family: Abel;">예승재</h4>
                <h2 class="text-gray-300   text-5xl text-center mt-2 mb-20" id="moka-cqg7a" style="font-family: &quot;Archivo Black&quot;;">Chatting</h2>
                <button onclick=location.href="{{ route('main') }}"
                value="button" class="hover:text-gray-300 bg-yellow-800 text-white hover:bg-black w-56 p-4 text-2xl font-bold" id="moka-8pwrq" style="font-family: Barlow;">게임 시작</button>
            </div>
        </div>
    </div>
</body>
</html>