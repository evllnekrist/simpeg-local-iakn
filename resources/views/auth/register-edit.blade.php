
@php
    // echo "<pre>";
    // print_r($selected);
    // echo "</pre>";
@endphp
<x-guest-layout>
    <form method="POST" action="{{ route('user.update') }}">
        @csrf

        <!-- ID -->
        <div>
            <input name="id" type="number" value="{{$selected->id}}" hidden>
            <x-input-error :messages="$errors->get('id')" class="mt-2" /><br><br>
        </div>
        
        <!-- Group Pengguna -->
        <div>
            <x-input-label for="user_group_id" :value="__('Satuan Kerja')" />
            <select class="form-control block mt-1 w-full" name="user_group_id" :value="old('user_group_id')" required autofocus autocomplete="user_group_id">
              <option disabled>------ pilih salah satu ------</option>
              @foreach(@$user_groups as $item)
                <option value="{{$item->id}}" {{$selected->user_group_id == $item->id?'selected':''}}>{{$item->nickname}} - {{$item->fullname}}</option>
              @endforeach
            </select>
            <x-input-error :messages="$errors->get('user_group_id')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-2">
            <x-input-label for="role_id" :value="__('Peran')" />
            <select class="form-control block mt-1 w-full" name="role_id" :value="old('role_id')" required autofocus autocomplete="role_id">
              <option disabled>------ pilih salah satu ------</option>
              @foreach(@$roles as $item)
                <option value="{{$item->id}}" {{$selected->role_id == $item->id?'selected':''}}>{{$item->name}}</option>
              @endforeach
            </select>
            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-2">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$selected->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$selected->email}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Ulang Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Simpan Pembaruan') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
