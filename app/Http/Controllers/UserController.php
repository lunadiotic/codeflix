<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createProfileForUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return 'User not found';
        }

        // Membuat profil baru
        $user->profile()->create([
            'phone' => '1234567890',
            'address' => 'Jalan Contoh',
        ]);

        return 'Profile created successfully!';
    }

    public function updateProfileForUser($userId)
    {
        $user = User::find($userId);

        // Periksa apakah profil sudah ada
        if ($user->profile) {
            $user->profile->update([
                'phone' => '9876543210',
                'address' => 'Jalan Contoh Baru',
            ]);
            return 'Profile updated successfully!';
        }

        return 'Profile not found.';
    }

    public function deleteProfileForUser($userId)
    {
        $user = User::find($userId);

        // Periksa apakah profil sudah ada
        if ($user->profile) {
            $user->profile->delete();
            return 'Profile deleted successfully!';
        }

        return 'Profile not found.';
    }
}
