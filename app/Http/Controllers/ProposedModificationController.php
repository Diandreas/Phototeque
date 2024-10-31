<?php

namespace App\Http\Controllers;

use App\Models\ProposedModification;
use Illuminate\Http\Request;

class ProposedModificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:images,id',
            'field' => 'required|string',
            'proposed_value' => 'required|string',
        ]);

        ProposedModification::create([
            'image_id' => $request->image_id,
            'user_id' => auth()->id(),
            'field' => $request->field,
            'proposed_value' => $request->proposed_value,
        ]);

        return back()->with('success', 'Modification proposed successfully.');
    }

    public function update(Request $request, ProposedModification $modification)
    {
//        if (!auth()->user()->isAdmin()) {
//            abort(403);
//        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $modification->status = $request->status;
        $modification->save();

        if ($request->status === 'accepted') {
            $image = $modification->image;
            $image->{$modification->field} = $modification->proposed_value;
            $image->save();
        }

        return back()->with('success', 'Modification ' . $request->status . ' successfully.');
    }
}
