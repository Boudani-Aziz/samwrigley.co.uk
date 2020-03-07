@extends('layouts.default')

@section('title', 'Contact')

@section('content')
    <div class="flex border-black border">
        <div class="w-1/2 p-16 border-r border-black">
            <h1 class="text-5xl font-black mb-8">
                Get in touch
            </h1>

            <div class="text-2xl">
                <ul class="text-gray-600 mb-8">
                    <li>How can I help you?</li>
                    <li>Tell me about yourself or your company</li>
                </ul>

                <p class="text-gray-600">
                    Fill out the form, or send me an <a href="mailto:{{ config('contact.email') }}" class="text-gray-900">email</a>.
                </p>
            </div>
        </div>

        <div class="w-1/2 p-16 text-xl">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div class="mb-8">
                    <label for="name" class="block mb-2">
                        Let's start with your name
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Full name"
                        autocomplete="name"
                        required
                        class="block w-full px-6 py-4 bg-gray-200"
                        max="100"
                    >
                </div>

                <div class="mb-8">
                    <label for="email" class="block mb-2">
                        Your email, so I can get back to you
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        autocomplete="email"
                        required
                        class="block w-full px-6 py-4 bg-gray-200"
                    >
                </div>

                <div class="mb-8">
                    <label for="message" class="block mb-2">
                        How can I help you?
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        value="{{ old('message') }}"
                        placeholder="Message"
                        rows="6"
                        required
                        class="block w-full px-6 py-4 bg-gray-200 mb-1"
                        aria-describedby="messageInformation"
                        max="2000"
                    ></textarea>
                    <div id="messageInformation" class="text-sm text-gray-600">
                        Maximum 2000 characters
                    </div>
                </div>

                <button
                    type="submit"
                    class="flex items-center text-white bg-gray-900 py-4 px-6 hover:bg-gray-800"
                >
                    <span class="mr-2">Get in touch</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 32 32"
                        class="w-6 fill-current"
                    >
                        <path d="M18 6l-1.43 1.39L24.15 15H3v2h21.15l-7.58 7.57L18 26l10-10L18 6z" />
                    </svg>
                </button>
            </form>

            <div class="mt-4">
                @include('components.general.errors', ['errorBag' => 'contact'])
                @include('components.general.session', ['key' => 'contact'])
            </div>
        </div>
    </div>
@endsection