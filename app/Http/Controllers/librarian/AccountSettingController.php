<?php

namespace App\Http\Controllers\librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Librarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function index(Request $request) {

        $user = User::with('librarian')->find(Auth::user()->id);

        return view('librarian.account_settings.index', compact('user'));
    }
    
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $userId = $request->personal_user_id;

            $user = User::with('librarian')->findOrFail($userId);
            $librarian = $user->librarian;

            // Full name
            $name = $request->firstName . ' ' . $request->lastName;

            $profilePath = $librarian->profile_picture;

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

            $librarian->update([
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
                ->route('librarian.account_settings.index')
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
