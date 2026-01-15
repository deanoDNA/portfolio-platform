@extends('layouts.dashboard')

@section('content')
<h1>Create Your Portfolio</h1>

<form class="portfolio-form" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- PERSONAL INFO -->
    <section>
        <h3>Personal Information</h3>

        <input type="text" placeholder="Full Name">
        <input type="text" placeholder="Professional Title">

        <textarea placeholder="Short Bio"></textarea>

        <input type="file">
        <input type="email" placeholder="Email">
        <input type="text" placeholder="Phone">
    </section>

    <!-- EDUCATION -->
    <section>
        <h3>Education</h3>
        <input type="text" placeholder="School / University">
        <input type="text" placeholder="Degree">
        <div class="row">
            <input type="number" placeholder="Start Year">
            <input type="number" placeholder="End Year">
        </div>
    </section>

    <!-- SKILLS -->
    <section>
        <h3>Skills</h3>
        <input type="text" placeholder="Skill Name">
        <select>
            <option>Beginner</option>
            <option>Intermediate</option>
            <option>Expert</option>
        </select>
    </section>

    <!-- EXPERIENCE -->
    <section>
        <h3>Experience</h3>
        <input type="text" placeholder="Company">
        <input type="text" placeholder="Role">
        <textarea placeholder="Description"></textarea>
    </section>

    <!-- ACTIONS -->
    <div class="actions">
        <button class="btn secondary">Preview</button>
        <button class="btn primary">Save Portfolio</button>
    </div>

</form>
@endsection
