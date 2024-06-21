<?php

namespace App\Http\Controllers;

use App\Models\Detail_OrganizationStructure;
use App\Models\OrganizationStructure;
use App\Models\Position;
use App\Models\UserManage;
use Illuminate\Http\Request;

class Detail_OSController extends Controller
{
    public function index()
    {
        $details = Detail_OrganizationStructure::with(['userManage', 'position'])->get();
        return response()->json($details);
    }

    public function show($id)
    {
        $detail = Detail_OrganizationStructure::with(['userManage', 'position'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $detail,
            'message' => 'Detail organization structure retrieved successfully'
        ]);
    }


    public function create()
    {
        $userManages = UserManage::where('status', 'Aktif')->get();
        $os = OrganizationStructure::all();
        $positions = Position::all();

        return response()->json(['positions' => $positions, 'userManages' => $userManages, 'os' => $os]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_os' => 'required',
            'id_um' => 'required',
            'id_posisi' => 'required',
            'nama_workgroup' => 'required',
        ]);

        $detail = Detail_OrganizationStructure::create($request->all());
        return response()->json($detail, 201);
    }

    public function edit($id)
    {
        $detail = Detail_OrganizationStructure::findOrFail($id);
        $userManages = UserManage::where('status', 'Aktif')->get();
        $positions = Position::all();

        return response()->json(['detail' => $detail, 'userManages' => $userManages, 'positions' => $positions]);
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     // 'id_os' => 'required',
        //     'id_um' => 'required',
        //     'id_posisi' => 'required',
        //     'nama_workgroup' => 'required',
        // ]);

        $detail = Detail_OrganizationStructure::findOrFail($id);
        $detail->update($request->all());
        return response()->json($detail);
    }

    // Menghapus detail struktur organisasi
    public function destroy($id)
    {
        $detail = Detail_OrganizationStructure::findOrFail($id);
        $detail->delete();
        return response()->json(['message' => 'Detail Organization Structure deleted']);
    }
}
