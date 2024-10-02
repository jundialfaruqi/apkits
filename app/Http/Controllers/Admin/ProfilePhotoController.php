<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProfilePhoto;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProfilePhotoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();
        $photo = $request->file('photo');
        $photoPath = $photo->store('profile-photos', 'public');

        $profilePhoto = $user->profilePhoto()->updateOrCreate(
            ['user_id' => $user->id],
            ['photo_path' => $photoPath]
        );

        if ($user->profilePhoto && $user->profilePhoto->photo_path !== $photoPath) {
            Storage::disk('public')->delete($user->profilePhoto->photo_path);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function destroy()
    {
        $user = auth()->user();
        if ($user->profilePhoto) {
            Storage::disk('public')->delete($user->profilePhoto->photo_path);
            $user->profilePhoto->delete();
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }
}
