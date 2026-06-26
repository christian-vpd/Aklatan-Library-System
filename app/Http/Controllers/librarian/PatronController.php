<?php

namespace App\Http\Controllers\librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Patron;
use App\Models\PatronType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PatronController extends Controller
{
    public function index(Request $request) {

        $patronType = PatronType::get();

        $patrons = Patron::with([
            'user:id,status,email',
        ])
        ->whereHas('user', function ($query) {
            $query->where('role', 'patron')
                ->whereNull('deleted_at');
        })
        ->latest()
        ->limit(100)
        ->get();

        return view('librarian.patron.index', compact('patronType', 'patrons'));
        
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

    private function generatePatronCode()
    {
        $year = now()->format('Y');

        $last = Patron::withTrashed()
            ->where('patron_code', 'like', "PAT{$year}%")
            ->orderBy('patron_code', 'desc')
            ->first();

        if (!$last) {
            return "PAT{$year}001";
        }

        $number = (int) substr($last->patron_code, -3);
        $next = str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        return "PAT{$year}{$next}";
    }

    public function store (Request $request) {

        DB::beginTransaction();

        try {

            // Determine patron code
            $patronCode = $this->generatePatronCode();

            // Build User
            $username = $patronCode;
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
                'role' => 'patron',
            ]);

            Patron::create([
                'user_id' => $user->id,
                'patron_code' => $patronCode,
                'last_name' => $request->lastName,
                'first_name' => $request->firstName,
                'middle_name' => $request->middleName ?? null,
                'suffix' => $request->suffix ?? null,
                'gender' => $request->gender,
                'contact_number' => $request->contactNumber,
                'profile_picture' => $profilePath,
                'patron_type_id' => $request->patronType,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Patron added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.patron.index')
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

    public function edit(Request $request, int $userId) {
        $user = User::with('patron')
        ->find($userId);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $userId = $request->edit_user_id;

            $user = User::with('patron')->findOrFail($userId);
            $patron = $user->patron;

            // Full name
            $name = $request->edit_firstName . ' ' . $request->edit_lastName;

            $profilePath = $patron->profile_picture;

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
                'status' => $request->edit_status,
            ]);

            $patron->update([
                'last_name' => $request->edit_lastName,
                'first_name' => $request->edit_firstName,
                'middle_name' => $request->edit_middleName ?? null,
                'suffix' => $request->edit_suffix ?? null,
                'gender' => $request->edit_gender,
                'contact_number' => $request->edit_contactNumber,
                'profile_picture' => $profilePath,
                'patron_type_id' => $request->edit_patronType,
            ]);

            DB::commit();

            return redirect()
                ->route('librarian.patron.index')
                ->with('notification', [
                    'message' => 'Patron updated successfully.',
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

    public function delete(int $userId) {
        DB::beginTransaction();

        try
        {
            $user = User::find($userId);
            $user->delete();
            
            DB::commit();

            return response()->json([
                'status' => 'success',
            ], 200);

        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function filter(Request $request) {
        $patronType = PatronType::all();

        $query = Patron::with([
            'user:id,status,email'
        ])
        ->whereHas('user', function ($query) use ($request) {
            $query->where('role', 'patron')
                ->whereNull('deleted_at');

            if ($request->filled('filter_status')) {
                $query->where('status', $request->filter_status);
            };
        });

        if ($request->filled('filter_gender')) {
            $query->where('gender', $request->filter_gender);
        };

        if ($request->filled('filter_patron_type_id')) {
            $query->where('patron_type_id', $request->filter_patron_type_id);
        };

        $patrons = $query
        ->latest()
        ->limit(200)
        ->get();

        return view('librarian.patron.index', compact('patronType', 'patrons'));
    }
}
