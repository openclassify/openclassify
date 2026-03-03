<?php
namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Profile\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Profile::firstOrCreate(['user_id' => auth()->id()]);
        return view('profile::show', compact('profile'));
    }

    public function edit()
    {
        $profile = Profile::firstOrCreate(['user_id' => auth()->id()]);
        return view('profile::edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url',
        ]);
        Profile::updateOrCreate(['user_id' => auth()->id()], $data);
        return redirect()->route('profile.show')->with('success', 'Profile updated!');
    }
}
