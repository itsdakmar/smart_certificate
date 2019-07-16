<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $message = [
            'regex' => ':attribute tidak betul pak.'
        ];

        $request->validate([
            'phone' => 'regex:/^(\+?6?01)[0-46-9]-*[0-9]{7,8}$/'
        ], $message);

        auth()->user()->update($request->all());


        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function upload(Request $request)
    {
        $file = $request->file('img');
        $fileName = 'avatar-' . auth()->user()->id . '.' . $request->file('img')->extension();

        if ($file) {
            if (Storage::disk('local')->has(auth()->user()->image_url)) {
                Storage::disk('local')->delete(auth()->user()->image_url);
            }

            Storage::disk('local')->put($fileName, File::get($file));
            auth()->user()->update(['image_url' => $fileName]);
        }

        return response()->json(200);
    }

    public function getProfileImage($filename)
    {
        try {
            $file = Storage::disk('local')->get($filename);
        } catch (FileNotFoundException $e) {
            return response($e->getMessage(), 500);
        }

        return response($file, 200);
    }
}
