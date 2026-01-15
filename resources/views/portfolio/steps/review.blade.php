@extends('layouts.dashboard')

@section('content')
@php
$currentStep = 4;
@endphp

<div class="max-w-4xl mx-auto bg-white rounded shadow p-6 space-y-6">
    @include('portfolio.steps.progress')

    <h2 class="font-semibold text-gray-800">Review Your Portfolio</h2>
    <p><strong>Full Name:</strong> {{ $portfolio->full_name }}</p>
    <p><strong>Gender:</strong> {{ $portfolio->gender }}</p>
    <p><strong>Skills:</strong> {{ $portfolio->skills }}</p>
    <p><strong>Education:</strong> {{ $portfolio->education }}</p>
    <p><strong>Experience:</strong> {{ $portfolio->experience }}</p>

    <div class="flex justify-between mt-4">
        <a href="{{ route('portfolio.step3') }}" class="px-4 py-2 border rounded text-sm">Back</a>
        <a href="{{ route('portfolio.step5') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Finish</a>
    </div>
</div>
@endsection
