<header x-data="{ open: false }" @click.outside="open = false"
    class="flex flex-col justify-center items-center bg-dark-first  text-white-first">
    <div class="container h-[64px] sticky top-0 px-[12px] flex justify-between font-spaceGrotesk">
        <a href="{{ route('home') }}" class="flex items-center uppercase font-[500] text-[28px]">Malano.</a>
        <nav role="navigation"
            class="w-full sm:max-w-[444px] lg:max-w-[488px] hidden sm:flex justify-between items-center [&>*]:w-[72px] lg:[&>*]:w-[72px] [&>*]:text-center [&>*]:text-[16px] [&>*]:font-[500] [&>*]:capitalize [&>*]:hover:text-blue-plus [&>*]:hover:cursor-pointer [&>*]:hover:transition-all [&>*]:hover:duration-200 ">
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'text-dark-first bg-white-first' : 'text-white-first bg-dark-first' }}">Home</a>
            <a href="{{ route('about') }}"
                class="{{ request()->routeIs('about') ? 'text-dark-first bg-white-first' : 'text-white-first bg-dark-first' }}">About</a>
            <a href="{{ route('works') }}"
                class="{{ request()->routeIs('works') ? 'text-dark-first bg-white-first' : 'text-white-first bg-dark-first' }}">Works</a>
            <a href="{{ route('contact') }}"
                class="{{ request()->routeIs('contact') ? 'text-dark-first bg-white-first' : 'text-white-first bg-dark-first' }}">Contact</a>
        </nav>
        {{-- burger menu --}}
        <button aria-label="Open menu" @click="open = !open" aria-label="Toggle navigation"
            :aria-expanded="open.toString()" aria-controls="mobile-nav" class="block sm:hidden">
            <x-elements-icon name="burger-menu" class="w-[32px] h-[32px]  fill-current text-white-first " />
        </button>
    </div>
    {{-- nav pada halaman mobile --}}
    <nav id="mobile-nav" role="navigation" x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="w-full absolute top-[64px] flex sm:hidden flex-col items-center bg-dark-first [&>*]:w-full [&>*]:py-[8px] [&>*]:text-center [&>*]:capitalize [&>*]:text-[16px] [&>*]:font-[500] [&>*]:text-white-first [&>*]:hover:bg-blue-second [&>*]:hover:text-blue-plus [&>*]:hover:cursor-pointer [&>*]:hover:transition-all [&>*]:hover:duration-200 ">
        <a href="{{ route('home') }}" @click="open = false">Home</a>
        <a href="{{ route('about') }}" @click="open = false">About</a>
        {{-- <a href="{{ route('works') }}" @click="open = false">Works</a> --}}
        {{-- <a href="{{ route('contact') }}" @click="open = false">Contact</a> --}}
    </nav>
</header>
