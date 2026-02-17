@extends('Layouts.app')
@section('content')

    @if(Session()->has('message'))

        <div class="bg-indigo-900 text-center py-4 lg:px-4">
            <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none
            lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1
                text-xs font-bold mr-3">Weee</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{
                session('message') }}</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757
                10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
        </div>
    @endif

        @if(session('error'))

        <div class="alert alert-danger">

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold"> {{ session('error') }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button"
    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2
    1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1
    1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
            </div>
       @endif

<section class="flex flex-col md:flex-row h-screen items-center">

    <div class="auth-banner">

        <div class="bg-indigo-600 md:hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <img src="{{ asset('storage/banner.png') }}" alt="banner" class="w-full h-full object-cover">
        </div>
    </div>

    <div class="bg-white md:w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3
     h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">

        <div class="w-full h-100">

            <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Log in to your account</h1>

            <form class="mt-6" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email Address"
                    class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                    focus:bg-white focus:outline-none" autofocus autocomplete required>
                </div>

                <div class="mt-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password"
                    minlength="3" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border
                    focus:border-blue-500
                focus:bg-white focus:outline-none" required>
                </div>

                <div class="text-right mt-2">
                    <a href="#" class="text-sm font-semibold text-gray-700 hover:text-blue-700
                    focus:text-blue-700">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400
                focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">
                    Log In</button>
            </form>

            <hr class="my-6 border-gray-300 w-full">

           <a href="{{ url('/auth/linkedin-openid') }}"> <button type="button" class="w-full
           block bg-white hover:bg-gray-100 focus:bg-gray-100
            text-gray-900 font-semibold rounded-lg px-4 py-3 border border-gray-300">
                <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="currentColor"
                         viewBox="0 0 24 24">
            <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.11 1 2.5 1 4.98 2.12 4.98 3.5zM.5
            8h4v16h-4V8zM8.5 8h3.8v2.2h.1c.5-1 1.9-2.2
            3.9-2.2 4.2 0 5 2.8 5 6.4V24h-4v-7.4c0-1.8 0-4.1-2.5-4.1s-2.9 1.9-2.9 4v7.5h-4V8z"/>
            </svg>
                    <span class="ml-4"> Log in with LinkedIn</span>
                </div>
            </button>
            </a>

            <p class="mt-8">Need an account? <a href="{{ route('auth.register') }}" class="text-blue-500
            hover:text-blue-700 font-semibold">Create an  account</a></p>


        </div>
    </div>

</section>

@endsection
