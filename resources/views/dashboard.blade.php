<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
</x-slot>

<div class="flex-1 h-full">
    <chat-component :current-user="{{ Auth::user()->id }}"></chat-component>
</div>
<The-Room/>







</x-app-layout>
