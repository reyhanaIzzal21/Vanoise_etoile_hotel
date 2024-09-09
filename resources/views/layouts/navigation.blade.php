<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vanoise Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        nav{
            background-color: rgba(0, 0, 0, .7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-[transparent] text-white">

<!-- Fixed Navbar -->
<nav x-data="{ open: false }" class=" text-white fixed w-full z-10 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <img src="{{ asset('aset/logo-vanoise.png') }}" alt="logo-vanoise" class="w-40">
            </div>
            <div class="hidden sm:flex sm:items-center">
                <div class="flex space-x-6">
                    <!-- Ensure all text is yellow -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="color: #EFD510 !important;" class="hover:text-[#FFDDDD] px-2 text-sm border-b border-[#EFD510] font-medium">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" style="color: #EFD510 !important;" class="hover:text-[#FFDDDD] px-2 text-sm border-b border-[#EFD510] font-medium">
                        {{ __('Kamar') }}
                    </x-nav-link>
                    <x-nav-link :href="route('room-types.index')" :active="request()->routeIs('room-types.index')" style="color: #EFD510 !important;" class="hover:text-[#FFDDDD] px-2 text-sm border-b border-[#EFD510] font-medium">
                        {{ __('Tipe Kamar') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" style="color: #EFD510 !important;" class="hover:text-[#FFDDDD] px-2 text-sm border-b border-[#EFD510] font-medium">
                        {{ __('Reservasi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guests.index')" :active="request()->routeIs('guests.index')" style="color: #EFD510 !important;" class="hover:text-[#FFDDDD] px-2.5 text-sm border-b border-[#EFD510] font-medium">
                        {{ __('Tamu') }}
                    </x-nav-link>
                </div>
                <x-dropdown align="right" width="48" class="ml-4">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-[#EFD510] bg-[rgba(0, 0, 0, .7)] hover:text-[#FFDDDD] focus:outline-none focus:bg-[#F2910A] transition duration-150 ease-in-out">
                            <div>Hi' {{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Hamburger button placed on the right -->
            <div class="absolute inset-y-0 right-0 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD] focus:outline-none focus:bg-[#F2910A] transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD]">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" class="text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD]">
                {{ __('Kamar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('room-types.index')" :active="request()->routeIs('room-types.index')" class="text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD]">
                {{ __('Tipe Kamar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" class="text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD]">
                {{ __('Reservasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guests.index')" :active="request()->routeIs('guests.index')" class="text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD]">
                {{ __('Tamu') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-[#EFD510]"> <!-- Updated border color -->
            <div class="px-4">
                <div class="font-medium text-base text-[#EFD510]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#EFD510]">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-[#EFD510] hover:bg-[#F2910A] hover:text-[#FFDDDD]">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Add some margin to the top of the content to account for the fixed navbar -->
<div class="pt-16">
    <!-- Page content goes here -->
</div>

</body>
</html>
