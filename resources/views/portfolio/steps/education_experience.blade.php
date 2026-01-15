@extends('layouts.dashboard')

@section('content')
@php
$currentStep = 3;
@endphp

<div class="max-w-4xl mx-auto bg-white rounded shadow p-6 space-y-6">
    @include('portfolio.steps.progress')

    <form method="POST" action="{{ route('portfolio.storeStep3') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Education</label>
                <textarea name="education" rows="3" class="w-full border rounded px-3 py-2">{{ old('education',$portfolio->education ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Experience</label>
                <textarea name="experience" rows="3" class="w-full border rounded px-3 py-2">{{ old('experience',$portfolio->experience ?? '') }}</textarea>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('portfolio.step2') }}" class="px-4 py-2 border rounded text-sm">Back</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Next</button>
            </div>
        </div>
    </form>
</div>
@endsection
