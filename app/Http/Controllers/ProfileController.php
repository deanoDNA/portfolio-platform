<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->user()->update($request->only('name'));

        return back()->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->user()->delete();

        return redirect('/');
    }
}
