<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,svg',
        ]);

        DB::beginTransaction();
        
        try {
            if($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath;
            }
            $validated['slug'] = Str::slug($request->name);

            Category::create($validated);
            DB::commit();
            
            return redirect()->route('admin.categories.index');
        } catch (Exception $e) {
            DB::rollBack();

            $error = ValidationException::withMessages([
                'system_error' => ('System Error! ' . $e->getMessage())
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
