@extends('app::layouts.app')

@section('title', 'Registration Disabled')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Registration is currently disabled</h1>
        <p class="mt-3 text-gray-600">
            Partner registration is available only when at least one social login provider is enabled by the admin.
        </p>

        <div class="mt-6 flex items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                Back Home
            </a>
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Giriş Yap
            </a>
        </div>
    </div>
</div>
@endsection
