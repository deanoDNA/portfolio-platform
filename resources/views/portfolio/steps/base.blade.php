@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-6 space-y-6">

    <!-- STEP PROGRESS -->
    <div class="flex items-center mb-6">
        @php
            $steps = ['Personal', 'Skills', 'Education & Experience', 'Review', 'Finish'];
        @endphp
        @foreach($steps as $index => $stepName)
            <div class="flex-1 text-center">
                <div class="w-8 h-8 mx-auto rounded-full {{ $currentStep==$index+1 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center">
                    {{ $index+1 }}
                </div>
                <span class="block mt-1 text-xs">{{ $stepName }}</span>
            </div>
            @if($index < count($steps)-1)
                <div class="flex-1 h-0.5 bg-gray-300 mt-4"></div>
            @endif
        @endforeach
    </div>

    <!-- STEP CONTENT -->
    @yield('step-content')

</div>
@endsection
