<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\Image;
use Illuminate\Http\Request;

class TermHasImageController extends Controller
{
    public function index()
    {
        $termHasImages = Term::with('images')->get();
        return view('term_has_images.index', compact('termHasImages'));
    }

    public function create()
    {
        $terms = Term::all();
        $images = Image::all();
        return view('term_has_images.create', compact('terms', 'images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'term_id' => 'required|exists:terms,id',
            'image_id' => 'required|exists:images,id',
        ]);

        $term = Term::find($request->term_id);
        $term->images()->attach($request->image_id);

        return redirect()->route('term_has_images.index')->with('success', 'Term has image created successfully.');
    }

    public function destroy($term_id, $image_id)
    {
        $term = Term::find($term_id);
        $term->images()->detach($image_id);

        return redirect()->route('term_has_images.index')->with('success', 'Term has image deleted successfully.');
    }
}
