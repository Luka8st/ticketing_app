<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $userAttributes = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'profile image' => ['image|mimes:jpg,png|max:2048']
        ]);

        // $employerAttributes = $request->validate([
        //     'employer' => 'required',
        //     'logo' => ['required', File::types(['png', 'jpg', 'webp'])]
        // ]);

        // dd($request->hasFile('profile_image'));

        if($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filePath = Storage::putFileAs('profile_image', $file, time().'.jpg');

            $userAttributes = Arr::except($userAttributes, "profile_image");
            $userAttributes['image_path'] = $filePath;
        }

        // dd($userAttributes);

        $user = User::create($userAttributes);

        // $logoPath = $request->logo->store('logos');

        // $user->employer()->create([
        //     'name' => $employerAttributes['employer'],
        //     'logo' => $logoPath
        // ]);

        Auth::login($user);

        return redirect(route('client.homepage'));
    }
}
