@extends('layouts.dashboard')

@section('content')
@php
$currentStep = 5;
@endphp

<div class="max-w-4xl mx-auto bg-white rounded shadow p-6 space-y-6">
    @include('portfolio.steps.progress')

    <div class="text-center space-y-4">
        <h2 class="text-lg font-semibold text-gray-800">Portfolio Completed!</h2>
        <p class="text-gray-600">Your portfolio is now complete. You can download it or share your public link.</p>
        <div class="flex justify-center gap-4 mt-4">
            <a href="{{ route('portfolio.download') }}" class="px-4 py-2 bg-green-600 text-white rounded">Download CV</a>
            <a href="{{ route('portfolio.public', $portfolio->id) }}" class="px-4 py-2 border rounded">View Public</a>
        </div>
    </div>
</div>
@endsection
