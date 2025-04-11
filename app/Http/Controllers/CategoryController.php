<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.dashboard.category.index', compact('categories'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'category' => 'required|string|max:255', // Keep 'category' as the field name
        'description' => 'required|string|max:1000',
    ]);

    // Create a new category and store it in the database
    $category = Category::create([
        'category' => $validated['category'], // Use 'category' as per the migration
        'description' => $validated['description'],
    ]);

    // Redirect to a specific route (e.g., category list) with a success message
    return redirect()->route('categories.index')->with('success', 'Category created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
