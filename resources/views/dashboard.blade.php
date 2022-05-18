<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white  max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="w-5/12 rounded border p-2">
                <livewire:ticket/>
            </div>
            <div class="w-7/12 rounded border p-2">
{{--                <x-jet-welcome />--}}
                <livewire:comment/>
            </div>
        </div>
    </div>
</x-app-layout>
