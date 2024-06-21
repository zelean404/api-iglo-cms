<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Detail_Product;
use App\Models\Product;
use App\Models\Type;
use App\Models\UserManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::with(['userManage.type', 'company', 'type'])->get();
        $products = Product::with(['userManage' => function($query) {
            $query->where('status', 'Aktif');
        }, 'userManage.type', 'company', 'type'])->get();

        return response()->json($products);
    }

    public function create()
    {
        $types = Type::all();
        $companies = Company::all();
        $userManages = UserManage::where('status', 'Aktif')->get();

        return response()->json([
            'types' => $types,
            'companies' => $companies,
            'userManages' => $userManages,
        ]);
    }

    public function store(Request $request)
    {
        // Generate ID
        $productId = 'product-' . date('dmYHis');

        $product = new Product($request->all());
        $product->id = $productId;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $product->image = $path;
        }

        $product->save();

        // Simpan detail file
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file) {
                $path = $file->store('files');
                Detail_Product::create([
                    'id_product' => $productId,
                    'nama_file' => $path,
                ]);
            }
        }

        return response()->json($product, 201);
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with(['userManage', 'company', 'type'])->findOrFail($id);
        $detailProducts = Detail_Product::where('id_product', $id)->get();

        return response()->json([
            'product' => $product,
            'detail_products' => $detailProducts,
        ]);
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        // $product = Product::findOrFail($id);
        $product = Product::with(['userManage', 'company', 'type'])->findOrFail($id);
        $detailProducts = Detail_Product::where('id_product', $id)->get();
        $types = Type::all();
        $companies = Company::all();
        $userManages = UserManage::where('status', 'Aktif')->get();

        return response()->json([
            'product' => $product,
            'types' => $types,
            'companies' => $companies,
            'userManages' => $userManages,
            'detailProducts' => $detailProducts,
        ]);
    }

    // Menyimpan perubahan pada produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('foto_produk');
            $product->image = $path;
        }

        $product->save();

        return response()->json($product);
    }

    public function update_file(Request $request, $id)
    {
        // Ambil detail file yang ada
        $existingFiles = Detail_Product::where('id_product', $id)->get();

        // Hapus file yang ada dari storage
        foreach ($existingFiles as $existingFile) {
            Storage::delete($existingFile->nama_file);
            $existingFile->delete();
        }

        // Simpan detail file baru
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('files');
                Detail_Product::create([
                    'id_product' => $id,
                    'nama_file' => $path,
                ]);
            }
        }

        return response()->json("sukses");
    }


    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Hapus file terkait
        $detailProducts = Detail_Product::where('id_product', $id)->get();
        foreach ($detailProducts as $detail) {
            Storage::delete($detail->nama_file);
            $detail->delete();
        }

        return response()->json('Data terhapus', 204);
    }
}
