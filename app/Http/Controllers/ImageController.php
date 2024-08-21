<?php

'size' => 'nullable|string|max:45',
        'description' => 'nullable|string',
    ]);

    $image->update($request->all());

    return redirect()->route('images.index')->with('success', 'Image updated successfully.');
}

public function destroy(Image $image)
{
    $image->delete();

    return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
}
