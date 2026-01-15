<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;






class PortfolioController extends Controller
{

    /* =========================
       STEP 1 – PERSONAL DETAILS
       ========================= */
    public function step1()
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        $countries = \App\Models\Country::orderBy('name')->get();
        $regions = $portfolio ? \App\Models\Region::where('country_id', $portfolio->country_id)->get() : [];
        $districts = $portfolio ? \App\Models\District::where('region_id', $portfolio->region_id)->get() : [];

        return view('portfolio.steps.personal', [
            'portfolio' => $portfolio,
            'currentStep' => 1,
            'countries' => $countries,
            'regions' => $regions,
            'districts' => $districts
        ]);
    }

    public function storeStep1(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'gender' => 'required|in:Male,Female',
        'country_id' => 'required|exists:countries,id',
        'region_id' => 'required|exists:regions,id',
        'district_id' => 'required|exists:districts,id',
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $portfolio = Portfolio::updateOrCreate(
        ['user_id' => Auth::id()],
        $validated + ['user_id' => Auth::id()]
    );

    // Handle photo upload
    if ($request->hasFile('profile_photo')) {
        if ($portfolio->profile_photo) {
            Storage::disk('public')->delete($portfolio->profile_photo);
        }
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $portfolio->update(['profile_photo' => $path]);
    }

    return redirect()->route('portfolio.step2')
                     ->with('success', 'Personal details saved.');
}

    /* =========================
       STEP 2 – SKILLS
       ========================= */
    public function step2()
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        return view('portfolio.steps.skills', [
            'portfolio' => $portfolio,
            'currentStep' => 2
        ]);
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'required|string|max:2000',
        ]);

        Portfolio::where('user_id', Auth::id())->update($validated);

        return redirect()->route('portfolio.step3')
                         ->with('success', 'Skills saved.');
    }

    /* =========================
       STEP 3 – EDUCATION & EXPERIENCE
       ========================= */
    public function step3()
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        return view('portfolio.steps.education_experience', [
            'portfolio' => $portfolio,
            'currentStep' => 3
        ]);
    }

    public function storeStep3(Request $request)
    {
        $validated = $request->validate([
            'education' => 'required|string|max:2000',
            'experience' => 'required|string|max:2000',
        ]);

        Portfolio::where('user_id', Auth::id())->update($validated);

        return redirect()->route('portfolio.step4')
                         ->with('success', 'Education & Experience saved.');
    }

    /* =========================
       STEP 4 – REVIEW
       ========================= */
    public function step4()
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        return view('portfolio.steps.review', [
            'portfolio' => $portfolio,
            'currentStep' => 4
        ]);
    }

    /* =========================
       STEP 5 – FINISH
       ========================= */
    public function step5()
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        return view('portfolio.steps.finish', [
            'portfolio' => $portfolio,
            'currentStep' => 5
        ]);
    }

    /* =========================
       UPDATE PROFILE PHOTO
       ========================= */
    public function updatePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $portfolio = Portfolio::updateOrCreate(
        ['user_id' => Auth::id()],
        ['user_id' => Auth::id()]
    );

    // Delete old photo
    if ($portfolio->profile_photo) {
        Storage::disk('public')->delete($portfolio->profile_photo);
    }

    $path = $request->file('profile_photo')->store('profile_photos', 'public');

    $portfolio->update([
        'profile_photo' => $path
    ]);

    return back()->with('success', 'Profile photo updated successfully.');
}




    /* =========================
       DOWNLOAD CV (PDF)
       ========================= */

    public function download()
    {
        $portfolio = Portfolio::with(['country', 'region', 'district'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $profileImage = null;

        if (!empty($portfolio->profile_photo)) {

            // Absolute path to uploaded file
            $absolutePath = storage_path('app/public/' . $portfolio->profile_photo);

            if (is_file($absolutePath)) {

                // Read file safely
                $imageData = file_get_contents($absolutePath);

                // Detect REAL mime type (CRITICAL FIX)
                $mimeType = mime_content_type($absolutePath);

                // Build valid Base64 image
                $profileImage = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
            }
        }

        $pdf = Pdf::loadView('portfolio.pdf.cv', [
            'portfolio'    => $portfolio,
            'profileImage' => $profileImage,
        ])->setPaper('A4', 'portrait');

        return $pdf->download(
            strtolower(str_replace(' ', '_', $portfolio->full_name)) . '_cv.pdf'
        );
    }

    
}