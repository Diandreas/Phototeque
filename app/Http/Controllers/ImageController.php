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
        if ($query) {
            $images = Image::where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->with('terms')
                ->paginate(12);
        } else {
            $images = Image::with('terms')->paginate(12);
        }

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
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create([
            'name' => $request->name,
            'path' => $imagePath,
            'size' => $request->file('image')->getSize(),
            'description' => $request->description,
        ]);

        return redirect()->route('images.index')->with('success', 'Image créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('comments.users', 'terms');

        return view('images.show', [
            'image' => $image
        ]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $image->path);
            $imagePath = $request->file('image')->store('images', 'public');
            $image->path = $imagePath;
            $image->size = $request->file('image')->getSize();
        }

        $image->name = $request->name;
        $image->description = $request->description;
        $image->save();

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
    public function download(Image $image)
    {
        $filePath = $image->path;
        $fileName = $image->name . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return Storage::download('public/' . $filePath, $fileName);
    }
}
