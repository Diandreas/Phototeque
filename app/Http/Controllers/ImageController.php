<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $images = Image::query();

        if ($query) {
            $images->where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        }

        $images = $images->with('terms')->paginate(12);

        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        return view('images.create', compact('terms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255|unique:images',
            'creation_date' => 'required|date',
            'author' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'support' => 'required|string|max:255',
            'dimensions' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'technique' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_subject' => 'required|string|max:255',
            'represented_elements' => 'required|string',
            'actions_represented' => 'required|string',
            'context' => 'required|string',
            'keywords' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create(array_merge($validatedData, [
            'path' => $imagePath,
            'size' => $request->file('image')->getSize(),
        ]));

        return redirect()->route('images.index')->with('success', 'Image créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('comments.users', 'terms');

        return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255|unique:images,identification_number,' . $image->id,
            'creation_date' => 'required|date',
            'author' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'support' => 'required|string|max:255',
            'dimensions' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'technique' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_subject' => 'required|string|max:255',
            'represented_elements' => 'required|string',
            'actions_represented' => 'required|string',
            'context' => 'required|string',
            'keywords' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $image->path);
            $imagePath = $request->file('image')->store('images', 'public');
            $image->path = $imagePath;
            $image->size = $request->file('image')->getSize();
        }

        $image->update($validatedData);

        return redirect()->route('images.index')->with('success', 'Image mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        Storage::delete('public/' . $image->path);
        $image->delete();

        return redirect()->route('images.index')->with('success', 'Image supprimée avec succès.');
    }

    /**
     * Download the specified resource.
     */
    public function download(Image $image)
    {
        $filePath = $image->path;
        $fileName = $image->name . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return Storage::download('public/' . $filePath, $fileName);
    }
}
