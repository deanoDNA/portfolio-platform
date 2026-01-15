@extends('layouts.dashboard')

@section('content')
@php
$currentStep = 1;
@endphp

<div class="max-w-4xl mx-auto bg-white rounded shadow p-6 space-y-6">

    <!-- STEP PROGRESS -->
    @include('portfolio.steps.progress')

    <!-- STEP 1 FORM -->
    <form method="POST" action="{{ route('portfolio.storeStep1') }}"
      action="{{ route('portfolio.storeStep1') }}"
      enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">

            <!-- Full Name -->
            <div>
                <label class="block text-sm font-medium">Full Name</label>
                <input type="text" name="full_name" value="{{ old('full_name', $portfolio->full_name ?? '') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium">Gender</label>
                <div class="flex gap-4 mt-1">
                    <label>
                        <input type="radio" name="gender" value="Male"
                               {{ (old('gender', $portfolio->gender ?? '') == 'Male') ? 'checked' : '' }}>
                        Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Female"
                               {{ (old('gender', $portfolio->gender ?? '') == 'Female') ? 'checked' : '' }}>
                        Female
                    </label>
                </div>
            </div>

            <!-- Country / Region / District -->
            <div>
                <label class="block text-sm font-medium">Country</label>
                <select name="country_id" id="country" class="w-full border rounded px-3 py-2">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                                {{ (old('country_id', $portfolio->country_id ?? '') == $country->id) ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Region</label>
                <select name="region_id" id="region" class="w-full border rounded px-3 py-2">
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}"
                                {{ (old('region_id', $portfolio->region_id ?? '') == $region->id) ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">District</label>
                <select name="district_id" id="district" class="w-full border rounded px-3 py-2">
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}"
                                {{ (old('district_id', $portfolio->district_id ?? '') == $district->id) ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Profile Photo Upload -->
            <div x-data="{ preview: '{{ isset($portfolio->profile_photo) ? asset('storage/' . $portfolio->profile_photo) : '' }}' }" class="space-y-2">
                <label class="block text-sm font-medium">Profile Photo</label>

                <div class="w-28 h-28 rounded-full overflow-hidden border bg-gray-100">
                    <img :src="preview" class="w-full h-full object-cover" x-show="preview">
                    <div x-show="!preview" class="w-full h-full flex items-center justify-center text-gray-400">
                        No Photo
                    </div>
                </div>

                

                <input type="file" name="profile_photo" accept="image/*"
                       @change="preview = URL.createObjectURL($event.target.files[0])"
                       class="block w-full text-sm mt-2">
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Next</button>
            </div>
        </div>
    </form>
</div>
@endsection















    <script>
document.addEventListener('DOMContentLoaded', function () {

    const country = document.getElementById('country');
    const region = document.getElementById('region');
    const district = document.getElementById('district');

    console.log('JS loaded');

    country.addEventListener('change', function () {
        console.log('Country changed:', this.value);

        region.innerHTML = '<option value="">Loading...</option>';
        district.innerHTML = '<option value="">Select District</option>';

        fetch(`/regions/${this.value}`)
            .then(res => res.json())
            .then(data => {
                console.log('Regions:', data);
                region.innerHTML = '<option value="">Select Region</option>';
                data.forEach(r => {
                    region.innerHTML += `<option value="${r.id}">${r.name}</option>`;
                });
            });
    });

    region.addEventListener('change', function () {
        console.log('Region changed:', this.value);

        fetch(`/districts/${this.value}`)
            .then(res => res.json())
            .then(data => {
                console.log('Districts:', data);
                district.innerHTML = '<option value="">Select District</option>';
                data.forEach(d => {
                    district.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                });
            });
    });

});
</script>



