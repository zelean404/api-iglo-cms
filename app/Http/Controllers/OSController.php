<?php

namespace App\Http\Controllers;

use App\Models\OrganizationStructure;
use Illuminate\Http\Request;

class OSController extends Controller
{
    public function index()
    {
        $organizationStructures = OrganizationStructure::all();
        return response()->json($organizationStructures);
    }

    public function create()
    {
        $organizationStructure = OrganizationStructure::all();

        return response()->json([
            'success' => true,
            'data' => [
                'organizationStructure' => $organizationStructure
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_department' => 'required|string',
            'parent_department' => 'nullable|string',
        ]);

        $organizationStructure = OrganizationStructure::create($request->all());
        return response()->json($organizationStructure, 201);
    }


    public function edit($id)
    {
        $organizationStructure = OrganizationStructure::find($id);

        if (!$organizationStructure) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        return response()->json($organizationStructure);
    }

    public function update(Request $request, $id)
    {
        $organizationStructure = OrganizationStructure::find($id);

        if (!$organizationStructure) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        // $request->validate([
        //     'nama_department' => 'required|string|max:255',
        //     'parent_department' => 'nullable|string|max:255',
        // ]);

        $organizationStructure->update([
            'nama_department' => $request->nama_department,
            'parent_department' => $request->parent_department,
        ]);

        return response()->json(['message' => 'Department updated successfully', 'data' => $organizationStructure]);
    }


    public function destroy($id)
    {
        $organizationStructure = OrganizationStructure::findOrFail($id);
        $organizationStructure->delete();
        return response()->json(['message' => 'Organization structure deleted']);
    }
}
