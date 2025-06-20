<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-[8px]">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6">
                    <p class="text-[18px] text-dark-first">Works By : {{ Auth::user()->username }}</p>
                </div>
                <x-table-works-table :works="$works" />
            </div>
        </div>
    </div>
</x-app-layout>
