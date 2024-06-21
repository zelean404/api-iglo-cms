<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserManageController extends Controller
{
    public function index()
    {
        $userManages = UserManage::with('role')->get(['id', 'nama', 'id_karyawan', 'email', 'telepon', 'id_role', 'password', 'status', 'foto', 'created_at', 'updated_at']);

        $userManages->each(function($userManage) {
            $userManage->nama_role = $userManage->role->nama_role;
        });

        return response()->json($userManages);
    }


    public function show($id)
    {
        $userManage = UserManage::with('role')
            ->select('user_manages.*')
            ->addSelect('roles.nama_role')
            ->join('roles', 'roles.id', '=', 'user_manages.id_role')
            ->where('user_manages.id', $id)
            ->first();

        if ($userManage)
        {
            return response()->json($userManage);
        }
        else
        {
            return response()->json(['message' => 'UserManage not found'], 404);
        }
    }


    public function create()
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles]);
    }

    public function store(Request $request)
    {

        dd($request);
        // $request->validate([
        //     'nama' => ['required', 'min:3', 'max:255'],
        // ]);

        // Handle file upload if there is a file
        $fotoPath = null;
        if ($request->hasFile('foto'))
        {
            $fotoPath = $request->file('foto')->store('public/fotos');
        }

        $password = Str::slug($request->nama) . '123';

        // Create new UserManage
        $userManage = UserManage::create([
            'nama' => $request->nama,
            'id_karyawan' => $request->id_karyawan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'id_role' => $request->id_role,
            'password' => Hash::make($password),
            'status' => 'Aktif',
            'foto' => $fotoPath,
        ]);

        return response()->json($userManage, 201);
    }


    public function edit($id)
    {
        try {
            // Cari user berdasarkan ID
            $userManage = UserManage::findOrFail($id);

            // Ambil semua roles
            $roles = Role::all();

            // Kembalikan response JSON
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $userManage,
                    'roles' => $roles
                ],
                'message' => 'User and roles retrieved successfully'
            ], 200);

        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user and roles: ' . $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());

        $userManage = UserManage::findOrFail($id);

        // Handle file upload if there is a file
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($userManage->foto) {
                Storage::delete($userManage->foto);
            }
            // Upload new foto
            $fotoPath = $request->file('foto')->store('public/fotos');
            $userManage->foto = $fotoPath;
        }

        // Update UserManage data
        $userManage->update([
            'nama' => $request->nama,
            'id_karyawan' => $request->id_karyawan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'id_role' => $request->id_role,
            'foto' => isset($fotoPath) ? $fotoPath : $userManage->foto,
        ]);

        return response()->json($userManage);
    }


    public function destroy($id)
    {
        $userManage = UserManage::findOrFail($id);

        $userManage->update([
            'status' => 'Tidak Aktif',
        ]);
        return response()->json(['message' => 'UserManage deleted']);

        // Delete associated foto if exists
        // if ($userManage->foto) {
        //     Storage::delete($userManage->foto);
        // }
        // $userManage->delete();
    }
}
