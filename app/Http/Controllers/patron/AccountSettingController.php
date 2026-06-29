<?php

namespace App\Http\Controllers\patron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patron;
use Illuminate\Support\Facades\Auth;

class AccountSettingController extends Controller
{
    public function index(Request $request) {

        $user = User::with('patron')->find(Auth::user()->id);

        return view('patron.account_settings.index', compact('user'));
    }

    public function checkEmail(Request $request) {
        $query = User::withTrashed()
        ->where('email', $request->email);

        // IMPORTANT: exclude current user in edit mode
        if ($request->user_id) {
            $query->where('id', '!=', $request->user_id);
        }

        // Checking
        $exists = $query->exists();

        return response()->json(!$exists);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $userId = $request->personal_user_id;

            $user = User::with('patron')->findOrFail($userId);
            $patron = $user->patron;

            // Full name
            $name = $request->firstName . ' ' . $request->lastName;

            $profilePath = $patron->profile_picture;

            if ($request->hasFile('profilePicture')) {

                // Delete old file if exists
                if ($profilePath && Storage::disk('public')->exists($profilePath)) {
                    Storage::disk('public')->delete($profilePath);
                }

                $file = $request->file('profilePicture');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                $profilePath = $file->storeAs(
                    'profile_pictures',
                    $filename,
                    'public'
                );
            }

            $user->update([
                'name' => $name,
                'email' => $request->email,
            ]);

            $patron->update([
                'last_name' => $request->lastName,
                'first_name' => $request->firstName,
                'middle_name' => $request->middleName ?? null,
                'suffix' => $request->suffix ?? null,
                'gender' => $request->gender,
                'contact_number' => $request->contactNumber,
                'profile_picture' => $profilePath,
            ]);

            DB::commit();

            return redirect()
                ->route('patron.account_settings.index')
                ->with('notification', [
                    'message' => 'Information updated successfully.',
                    'alert_type' => 'success',
                    'title' => 'Success',
                ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function changePassword(Request $request) {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->change_user_id);

            // Check old password
            if (!Hash::check($request->old_password, $user->password)) {
                DB::rollback();

                return redirect()
                ->back()
                ->with('notification', [
                    'message' => 'Old Password is incorrect.',
                    'alert_type' => 'error',
                    'title' => 'Invalid Password',
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            DB::commit();

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('notification', [
                    'message' => 'Password changed successfully. Please login again.',
                    'alert_type' => 'success',
                    'title' => 'Success',
                ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
