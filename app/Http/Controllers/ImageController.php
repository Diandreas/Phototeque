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
        $request->validate([
            'name' => 'required|string|max:255',
            'creation_date' => 'required|date',
            'author' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_subject' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'terms' => 'nullable|array',
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');

        // Obtenir les dimensions de l'image
        $dimensions = getimagesize($image->path());
        $width = $dimensions[0];
        $height = $dimensions[1];

        // Déterminer si l'image est en couleur ou en noir et blanc
        $colorType = $this->getColorType($image->path());

        // Générer un numéro d'identification unique
        $identificationNumber = $this->generateUniqueIdentificationNumber();

        $newImage = Image::create([
            'name' => $request->name,
            'identification_number' => $identificationNumber,
            'creation_date' => $request->creation_date,
            'author' => $request->author,
            'source' => $request->source,
            'support' => 'Numérique',
            'dimensions' => $width . 'x' . $height,
            'color' => $colorType,
            'description' => $request->description,
            'main_subject' => $request->main_subject,
            'path' => $imagePath,
            'size' => $image->getSize(),
        ]);

        if ($request->has('terms')) {
            $newImage->terms()->attach($request->terms);
        }

        return redirect()->route('images.index')->with('success', 'Image ajoutée avec succès.');
    }
    private function generateUniqueIdentificationNumber()
    {
        do {
            $number = strtoupper(Str::random(8)); // Génère une chaîne aléatoire de 8 caractères
        } while (Image::where('identification_number', $number)->exists());

        return $number;
    }
    private function getColorType($imagePath): string
    {
        $image = imagecreatefromstring(file_get_contents($imagePath));
        $width = imagesx($image);
        $height = imagesy($image);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($image, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                if ($r != $g || $g != $b) {
                    imagedestroy($image);
                    return 'Couleur';
                }
            }
        }

        imagedestroy($image);
        return 'Noir et blanc';
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
