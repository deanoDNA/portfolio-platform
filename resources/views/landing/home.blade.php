@extends('layouts.landing')

@section('content')
<section class="hero">

    <!-- Floating Words -->
    <div class="floating-words">
        <span>Create</span>
        <span>Build</span>
        <span>Share</span>
        <span>Download CV</span>
    </div>

    <!-- Center Logo -->
    <div class="hero-center">
        <!-- <img src="{{ asset('images/logo.png') }}" class="hero-logo"> -->
        <h1>Create Your Professional Portfolio & CV</h1>
        <p>Build once. Download anytime.</p>

        <div class="hero-buttons">
            <a href="/register" class="btn primary">Get Started</a>
            <a href="/login" class="btn secondary">Login</a>
        </div>
    </div>

    <div class="hero-section">
    <!-- Content here -->
</div>


</section>
@endsection
