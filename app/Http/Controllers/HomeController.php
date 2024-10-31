<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Term;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Image::withCount('comments')->with('terms');

        // Recherche
        if ($request->has('search') && $request->input('search') !== '') {
            $query = $query->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('description', 'like', '%' . $request->input('search') . '%');
        }

        // Filtrage
        if ($request->has('category') && $request->input('category') !== '') {
            $query = $query->whereHas('terms', function ($q) use ($request) {
                $q->where('name', $request->input('category'));
            });
        }

        if ($request->has('size') && $request->input('size') !== '') {
            $query = $query->where('size', $request->input('size'));
        }

        if ($request->has('date') && $request->input('date') !== '') {
            $date = explode('-', $request->input('date'));
            $query = $query->whereBetween('created_at', [
                $date[0] . '-01-01', $date[1] . '-12-31'
            ]);
        }

        $images = $query->orderByDesc('created_at')->get();
        $categories = Term::all();

        return view('home', [
            'images' => $images,
            'categories' => $categories,
            'filters' => [
                'search' => $request->input('search'),
                'category' => $request->input('category'),
                'size' => $request->input('size'),
                'date' => $request->input('date'),
            ]
        ]);
    }

    public function create()
    {
        $categories = Term::all();
        return view('images.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'categories' => 'array',
            'categories.*' => 'exists:terms,id',
        ]);

        $image = new Image();
        $image->name = $validatedData['name'];
        $image->description = $validatedData['description'];
        $image->path = $request->file('image')->store('images', 'public');
        $image->size = $request->file('image')->getSize();
        $image->save();

        $image->terms()->attach($validatedData['categories']);

        return redirect()->route('home')->with('success', 'Image ajoutée avec succès.');
    }

}
