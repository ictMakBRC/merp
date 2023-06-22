<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentManagement\DmRequestDocuments;

class GeneralController extends Controller
{
    public function viewDocument($id)
    {
        $document = DmRequestDocuments::where('id', $id)->first();
        // return $document;
        // $document->increment('downloads',1);
        $file = $document->original_file;
        if (! Storage::exists($file)) {
            abort(404);
        }

        $mimeType = Storage::mimeType($file);

        // Return the file using the 'file' function
        return response()->file(Storage::path($file), [
            'Content-Type' => $mimeType,
        ]);

        if (file_exists($file)) {
            return Storage::download($document->file, $document->title.' downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found!']);
        }
    }
}
