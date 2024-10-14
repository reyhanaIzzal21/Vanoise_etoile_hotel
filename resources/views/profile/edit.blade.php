<!-- resources/views/profile/edit.blade.php -->

<x-myprofile>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-hitam dark:text-putih leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-abu dark:bg-hitam">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Profile Header -->
            <div class="profile-header flex items-center space-x-6 mb-8">
                <div class="profile-avatar">
                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Photo"
                            class="w-28 h-28 rounded-full border-4 border-biru">
                    @else
                        <img src="{{ asset('aset/3d-mini-chatbot.png') }}" alt="Default Profile Photo"
                            class="w-28 h-28 rounded-full border-4 border-biru">
                    @endif
                </div>
                <div class="profile-info">
                    <h3 class="text-3xl font-bold text-hitam dark:text-putih">{{ $user->name }}</h3>
                    <p class="text-lg text-abu-muda">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Update Profile Information Form -->
            <div class="bg-putih dark:bg-abu p-8 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-hitam dark:text-putih mb-4">{{ __('Profile Information') }}</h3>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="text-biru font-medium" />
                        <x-text-input id="name" name="name" type="text"
                            class="block w-full mt-1 rounded-lg border border-abu-muda focus:border-biru focus:ring focus:ring-biru focus:ring-opacity-50"
                            :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-biru font-medium" />
                        <x-text-input id="email" name="email" type="email"
                            class="block w-full mt-1 rounded-lg border border-abu-muda focus:border-biru focus:ring focus:ring-biru focus:ring-opacity-50"
                            :value="old('email', $user->email)" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Profile Photo -->
                    <div>
                        <x-input-label for="profile_photo" :value="__('Profile Photo')" class="text-biru font-medium" />
                        <input id="profile_photo" type="file" name="profile_photo"
                            class="block w-full mt-1 rounded-lg border border-abu-muda focus:border-biru focus:ring focus:ring-biru focus:ring-opacity-50"
                            accept="image/*">
                        <x-input-error :messages="$errors->get('profile_photo')" class="mt-2 text-red-500" />

                        <!-- Display Current Photo -->
                        @if ($user->profile_photo_path)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo"
                                    class="w-28 h-28 rounded-full border-4 border-biru">
                            </div>
                        @endif
                    </div>

                    <!-- Save Button -->
                    <div class="flex justify-end">
                        <button
                            class="profile-button bg-biru hover:bg-biru-tua text-putih font-semibold py-2 px-6 rounded-lg shadow-md transform hover:scale-105 transition-transform">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password Form -->
            <div class="bg-putih dark:bg-abu p-8 rounded-lg shadow-lg mt-6">
                <h3 class="text-lg font-semibold text-hitam dark:text-putih mb-4">{{ __('Update Password') }}</h3>
                <div class="space-y-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="bg-putih dark:bg-abu p-8 rounded-lg shadow-lg mt-6">
                <h3 class="text-lg font-semibold text-hitam dark:text-putih mb-4">{{ __('Delete Account') }}</h3>
                <div class="space-y-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-myprofile>
