<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-[8px]">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 flex gap-[16px]">
                    <p class="text-[18px] text-dark-first">Works By : {{ Auth::user()->username }}</p>
                    <a href=""><button id="{{ $work->id }}"
                            class="inline-flex items-center cursor-pointer text-sm font-medium hover:bg-gray-100  p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none "
                            type="button">
                            Edit
                        </button></a>
                    <a href=""><button id="{{ $work->id }}"
                            class="inline-flex items-center cursor-pointer text-sm font-medium hover:bg-gray-100  p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none "
                            type="button">
                            Delete
                        </button></a>
                </div>
                <x-partials-works-detail-work :work="$work" />
            </div>
        </div>
    </div>
</x-app-layout>
