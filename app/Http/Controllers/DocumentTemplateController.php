<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentTemplate;
use Illuminate\Support\Facades\Storage;

class DocumentTemplateController extends Controller
{
    public function index()
    {
        return response()->json(DocumentTemplate::all());
    }


    public function store(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|file|mimes:pdf,doc,docx'
        // ]);

        $file = $request->file('file');
        $path = $file->store('documents_template');

        $documentTemplate = new DocumentTemplate();
        $documentTemplate->nama_file = $file->getClientOriginalName();
        $documentTemplate->size = $file->getSize();
        $documentTemplate->file = $path;
        $documentTemplate->id_user_manage = $request->id_user_manage;
        $documentTemplate->save();

        return response()->json($documentTemplate, 201);
    }


    public function edit($id)
    {
        $documentTemplate = DocumentTemplate::findOrFail($id);
        return response()->json($documentTemplate);
    }

    public function update(Request $request, $id)
    {
        $documentTemplate = DocumentTemplate::findOrFail($id);

        $request->validate([
            'file' => 'sometimes|file|mimes:pdf,doc,docx'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::delete($documentTemplate->file);

            // Store new file
            $file = $request->file('file');
            $path = $file->store('documents_template');

            // Update document details
            $documentTemplate->nama_file = $file->getClientOriginalName();
            $documentTemplate->size = $file->getSize();
            $documentTemplate->file = $path;
            $documentTemplate->id_user_manage = $request->id_user_manage;
        }

        $documentTemplate->save();

        return response()->json($documentTemplate);
    }

    // Delete a document template
    public function destroy($id)
    {
        $documentTemplate = DocumentTemplate::findOrFail($id);
        Storage::delete($documentTemplate->file);
        $documentTemplate->delete();

        return response()->json(null, 204);
    }
}
