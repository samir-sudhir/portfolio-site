<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    public function upload(Request $request)
{
    try {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('cvs', 'public');
            $cv = CV::first();

            if ($cv) {
                Storage::disk('public')->delete($cv->file_path);
                $cv->update(['file_path' => $path]);
            } else {
                CV::create(['file_path' => $path]);
            }

            return response()->json(['message' => 'CV uploaded successfully', 'file_path' => $path], 201);
        }

        return response()->json(['error' => 'File not uploaded'], 400);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function download()
    {
        $cv = CV::first();

        if ($cv && Storage::disk('public')->exists($cv->file_path)) {
            $fileUrl = asset('storage/' . $cv->file_path);
            return response()->json(['file_url' => $fileUrl]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function updateCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $cv = CV::first();

        if ($cv) {
            // Delete old file
            Storage::disk('public')->delete($cv->file_path);
            $path = $request->file('cv')->store('cvs', 'public');
            $cv->update(['file_path' => $path]);

            return response()->json(['message' => 'CV updated successfully', 'file_path' => $path], 200);
        }

        return response()->json(['error' => 'No CV to update'], 404);
    }
}

