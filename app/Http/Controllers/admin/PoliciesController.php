<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Policies;
use App\Models\PolicyCategories;
use Illuminate\Support\Facades\Log;

class PoliciesController extends Controller
{
    public function index(Request $request) {

        $categories = PolicyCategories::all();
        $selectedCategory = null;

        return view('admin.policies.index', compact('categories', 'selectedCategory'));
    }

    public function category(int $category_id) {

        $categories = PolicyCategories::all();

        $selectedCategory = PolicyCategories::with('policies')->find($category_id);

        return view('admin.policies.index', compact('categories', 'selectedCategory'));
    }

    public function categoryStore(Request $request) {
        
        try {
            DB::beginTransaction();

            $store = PolicyCategories::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Policy Category Store successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            $categories = PolicyCategories::all();

            $selectedCategory = PolicyCategories::with('policies')->find($store->id);

            return redirect()
            ->route('admin.policies.index')
            ->with('notification', $notification)
            ->with('categories', $categories)
            ->with('selectedCategory', $selectedCategory);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function categoryUpdate(Request $request) {
        
        try {
            DB::beginTransaction();

            $update = PolicyCategories::find($request->edit_category_id);

            $update->update([
                'name' => $request->edit_name,
                'description' => $request->edit_description,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Policy Category Update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            $categories = PolicyCategories::all();

            $selectedCategory = PolicyCategories::with('policies')->find($update->id);

            return redirect()
            ->route('admin.policies.index')
            ->with('notification', $notification)
            ->with('categories', $categories)
            ->with('selectedCategory', $selectedCategory);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function categoryDelete(int $category_id) {
        try {
            DB::beginTransaction();

            $delete = PolicyCategories::with('policies')->find($category_id);

            $count = $delete->policies->count();

            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'text' => "There are still policies on this category.",
                ], 200);
            }

            DB::commit();

            $delete->delete();

            return response()->json([
                'status' => 'success',
            ], 200);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request) {
        
        try {
            DB::beginTransaction();

            $store = Policies::create([
                'policy_category_id' => $request->policy_category_id,
                'title' => $request->title,
                'body' => $request->body,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Policy Store successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            $categories = PolicyCategories::all();

            $selectedCategory = PolicyCategories::with('policies')->find($store->id);

            return redirect()
            ->route('admin.policies.index')
            ->with('notification', $notification)
            ->with('categories', $categories)
            ->with('selectedCategory', $selectedCategory);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request) {
        
        try {
            DB::beginTransaction();

            $update = Policies::find($request->policy_id);

            $update->update([
                'title' => $request->edit_title,
                'body' => $request->edit_body,
                'is_active' => $request->edit_is_active == 'on' ? 1 : 0,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Policy Update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            $categories = PolicyCategories::all();

            $selectedCategory = PolicyCategories::with('policies')->find($update->id);

            return redirect()
            ->route('admin.policies.index')
            ->with('notification', $notification)
            ->with('categories', $categories)
            ->with('selectedCategory', $selectedCategory);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function delete(int $policy_id) {
        try {
            DB::beginTransaction();

            $delete = Policies::find($policy_id);
            $delete->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
            ], 200);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
