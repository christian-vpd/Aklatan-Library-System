<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Librarian;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LibrarianController extends Controller
{
    public function index(Request $request) {

        $librarians = User::with('librarian')
        ->where('deleted_at', null)
        ->where('status', 'active')
        ->where('role', 'librarian')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.manage_librarians.index', compact('librarians'));
    }

    private function generateLibrarianCode()
    {
        $year = now()->format('Y');

        $last = Librarian::withTrashed()
            ->where('librarian_code', 'like', "LIBRA{$year}%")
            ->orderBy('librarian_code', 'desc')
            ->first();

        if (!$last) {
            return "LIBRA{$year}001";
        }

        $number = (int) substr($last->librarian_code, -3);
        $next = str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        return "LIBRA{$year}{$next}";
    }

    public function store (Request $request) {

        DB::beginTransaction();

        try {

            // Determine librarian code
            $librarianCode = $request->libraryCode;

            if (!$request->has('customCodeCheck') || !$librarianCode) {
                $librarianCode = $this->generateLibrarianCode();
            }

            // Build User
            $username = $librarianCode;
            $name = $request->firstName . ' ' . $request->lastName;

            // Profile Picture
            $profilePath = null;

            if ($request->hasFile('profilePicture')) {
                $file = $request->file('profilePicture');

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                $profilePath = $file->storeAs(
                    'profile_pictures',
                    $filename,
                    'public'
                );
            }

            // Insert Data
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $request->email,
                'password' => Hash::make($username),
                'role' => 'librarian',
            ]);

            Librarian::create([
                'user_id' => $user->id,
                'librarian_code' => $librarianCode,
                'last_name' => $request->lastName,
                'first_name' => $request->firstName,
                'middle_name' => $request->middleName ?? null,
                'suffix' => $request->suffix ?? null,
                'gender' => $request->gender,
                'contact_number' => $request->contactNumber,
                'profile_picture' => $profilePath,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Librarian added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('admin.manage_librarians.index')
                ->with('notification', $notification);

        }
        catch(\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);

        }
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

    public function edit(Request $request, int $userId) {
        $user = User::with('librarian')
        ->find($userId);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $userId = $request->edit_user_id;

            $user = User::with('librarian')->findOrFail($userId);
            $librarian = $user->librarian;

            // Full name
            $name = $request->edit_firstName . ' ' . $request->edit_lastName;

            $profilePath = $librarian->profile_picture;

            if ($request->hasFile('edit_profilePicture')) {

                // Delete old file if exists
                if ($profilePath && Storage::disk('public')->exists($profilePath)) {
                    Storage::disk('public')->delete($profilePath);
                }

                $file = $request->file('edit_profilePicture');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                $profilePath = $file->storeAs(
                    'profile_pictures',
                    $filename,
                    'public'
                );
            }

            $user->update([
                'name' => $name,
                'email' => $request->edit_email,
            ]);

            $librarian->update([
                'last_name' => $request->edit_lastName,
                'first_name' => $request->edit_firstName,
                'middle_name' => $request->edit_middleName ?? null,
                'suffix' => $request->edit_suffix ?? null,
                'gender' => $request->edit_gender,
                'contact_number' => $request->edit_contactNumber,
                'profile_picture' => $profilePath,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.manage_librarians.index')
                ->with('notification', [
                    'message' => 'Librarian updated successfully.',
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
}