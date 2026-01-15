<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $portfolio->full_name }} - CV</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
        }

        .container {
            display: table;
            width: 100%;
            height: 100%;
        }

        .sidebar {
            display: table-cell;
            width: 30%;
            background: #f3f4f6;
            padding: 20px;
            vertical-align: top;
        }

        .content {
            display: table-cell;
            width: 70%;
            padding: 25px;
            vertical-align: top;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 13px;
            color: #2563eb;
            border-bottom: 1px solid #ddd;
            margin-bottom: 6px;
            padding-bottom: 3px;
        }

        .item {
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- LEFT SIDEBAR -->
    <div class="sidebar">

        <!-- @if($portfolio->profile_photo) -->
    <!-- <img
        src="{{ public_path('storage/' . $portfolio->profile_photo) }}"
        style="width:120px;height:120px;object-fit:cover;border-radius:6px;margin-bottom:12px;">
    @endif -->

    <!-- @if($portfolio->profile_photo)
    <img src="{{ public_path('storage/' . $portfolio->profile_photo) }}"
         style="width:120px;height:120px;object-fit:cover;border-radius:6px;">
@endif -->

            @if($profileImage)
    <img src="{{ $profileImage }}"
         style="
            width:120px;
            height:120px;
            object-fit:cover;
            /* border-radius:50%; */
            border:2px solid #111;
            margin-bottom:12px;
         ">
@else
    <div style="width:120px;height:120px;border:2px dashed #aaa;"></div>
@endif

      





        <h1>{{ $portfolio->full_name }}</h1>
        <p>{{ $portfolio->gender }}</p>

        <br>

        <h3>Personal Details</h3>

        <div class="item">
            <span class="label">Nationality:</span><br>
            {{ $portfolio->country->name ?? '' }}
        </div>

        <div class="item">
            <span class="label">Location:</span><br>
            {{ $portfolio->region->name ?? '' }},
            {{ $portfolio->district->name ?? '' }}
        </div>

        <br>

        <h3>Skills</h3>
        <p>{{ $portfolio->skills }}</p>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">

        <h2>{{ $portfolio->title }}</h2>

        <h3>Profile Summary</h3>
        <p>{{ $portfolio->summary }}</p>

        <h3>Education</h3>
        <p>{{ $portfolio->education }}</p>

        <h3>Work Experience</h3>
        <p>{{ $portfolio->experience }}</p>

    </div>

</div>

</body>
</html>
