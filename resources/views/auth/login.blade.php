@extends('layouts.island')

@section('title', __('Login'))

@section('island')
    <div  class="w-1/4">
        <h1 class="text-2xl font-bold mb-3">
            {{ __('Login') }}
        </h1>

        <div class="p-8 bg-white rounded shadow-md">
            <x-form route="{{ route('login') }}">
                <x-input
                    name="email"
                    type="email"
                    label="{{ __('Email') }}"
                    placeholder="{{ __('Your email') }}"
                    auto-complete="email"
                    required="true"
                    autofocus="true"
                />

                <x-input
                    name="password"
                    type="password"
                    label="{{ __('Password') }}"
                    placeholder="{{ __('Your password') }}"
                    auto-complete="current-password"
                    required="true"
                />

                <x-checkbox
                    name="remember"
                    label="{{ __('Remember me') }}"
                />

                <button
                    type="submit"
                    class="flex items-center text-white bg-gray-900 py-3 px-4 rounded hover:bg-gray-800"
                >
                    <span class="mr-2">{{ __('Login') }}</span>
                    <x-heroicon-o-arrow-right class="w-3 fill-current md:w-4" />
                </button>
            </x-form>
        </div>
    </div>
@endsection
