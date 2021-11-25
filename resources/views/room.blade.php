<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room') }}
        </h2>
    </x-slot>
<the-room :room="{{ $room }}" :room-id="{{ $room->id }}" :current-user="{{ Auth::user() }}"></the-room>
</x-app-layout>