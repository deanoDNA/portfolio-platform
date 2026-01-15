@extends('layouts.dashboard')

@section('content')

<h1 class="text-lg font-semibold text-gray-800 mb-6">
    Dashboard Overview
</h1>


<div class="bg-white border rounded p-6">

@if($portfolio)
<div class="bg-white border rounded p-4 mb-6">
    <p class="text-sm font-medium text-gray-700 mb-2">
        Portfolio Completion
    </p>

    <div class="w-full bg-gray-200 rounded h-3">
        <div class="bg-indigo-600 h-3 rounded"
             style="width: {{ $portfolio->completionPercentage() }}%">
        </div>
    </div>

    <p class="text-xs text-gray-500 mt-1">
        {{ $portfolio->completionPercentage() }}% completed
    </p>
</div>
@endif

    <table class="text-sm w-full">
        <tr>
            <td class="font-medium text-gray-600 w-40">Full Name</td>
            <td>{{ $portfolio->full_name ?? auth()->user()->name }}</td>
        </tr>

        <tr>
            <td class="font-medium text-gray-600">Email</td>
            <td>{{ auth()->user()->email }}</td>
        </tr>

        <tr>
            <td class="font-medium text-gray-600">Portfolio Status</td>
            <td>
                @if($portfolio)
                    <span class="text-green-600 font-medium">Completed</span>
                @else
                    <span class="text-red-600 font-medium">Not Created</span>
                @endif
            </td>
        </tr>
    </table>
</div>

@endsection
