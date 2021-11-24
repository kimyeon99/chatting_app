<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
</x-slot>

<div class="flex-1 h-full">
    <chat-component :current-user="{{ Auth::user()->id }}" :room-id="0"></chat-component>
</div>
<create-room/>

</x-app-layout>

@include('modal.createRoom')

<a href="#" class="btn btn-success" data-toggle="modal" data-target="#createModal">
    <span style="color:white">{{ __('New') }}</span> 
</a>
