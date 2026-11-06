<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Pertunjukan;
use Illuminate\Http\Request;
use App\Http\Resources\PertunjukanResource;

class PertunjukanController extends Controller
{
    
public function index(Request $request)
{
    $query = Pertunjukan::query();

    // Pencarian nama atau lokasi pertunjukan
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
              ->orWhere('location', 'like', "%{$keyword}%");
        });
    }

    // Filter berdasarkan lokasi
    if ($request->filled('location')) {
        $query->where('location', $request->location);
    }

    // Jumlah data per halaman
    $limit = min(max((int) $request->input('limit', 10), 1), 100);

    // Pagination
    $pertunjukans = $query->orderBy('id')
                          ->paginate($limit);

    return response()->json([
        'message' => 'Daftar pertunjukan berhasil diambil',
        'data' => PertunjukanResource::collection(
            $pertunjukans->items()
        ),
        'pagination' => [
            'current_page' => $pertunjukans->currentPage(),
            'last_page' => $pertunjukans->lastPage(),
            'per_page' => $pertunjukans->perPage(),
            'total' => $pertunjukans->total(),
        ]
    ], 200);
}


    // Menambahkan pertunjukan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|string|max:100',
            'time' => 'required|string|max:100',
            'price_domestic' => 'required|numeric|min:0',
            'price_foreign' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            
        ]);
        

        $data = $validated;

if ($request->hasFile('image')) {
    $data['image'] = $request->file('image')
        ->store('pertunjukans', 'public');
}

$pertunjukan = Pertunjukan::create($data);
        return response()->json([
        'message' => 'Pertunjukan berhasil ditambahkan',
         'data' => new PertunjukanResource($pertunjukan)
        ], 201);
    }

    public function show(Pertunjukan $pertunjukan)
{
    return response()->json([
        'message' => 'Detail pertunjukan berhasil diambil',
        'data' => new PertunjukanResource($pertunjukan)
    ], 200);
}
    // Memperbarui pertunjukan
    public function update(Request $request, Pertunjukan $pertunjukan)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|string|max:100',
            'time' => 'sometimes|required|string|max:100',
            'price_domestic' => 'sometimes|required|numeric|min:0',
            'price_foreign' => 'sometimes|required|numeric|min:0',
            'quota' => 'sometimes|required|integer|min:0',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            if ($pertunjukan->image) {
                Storage::disk('public')->delete($pertunjukan->image);
            }

            $data['image'] = $request->file('image')
                ->store('pertunjukans', 'public');
        }

        $pertunjukan->update($data);
                return response()->json([
            'message' => 'Pertunjukan berhasil diperbarui',
            'data' => new PertunjukanResource($pertunjukan->fresh())
        ], 200);
            }

   // Menghapus pertunjukan
public function destroy(Pertunjukan $pertunjukan)
{
    if ($pertunjukan->image) {
        Storage::disk('public')->delete($pertunjukan->image);
    }

    $pertunjukan->delete();

    return response()->json([
        'message' => 'Pertunjukan berhasil dihapus'
    ], 200);
}
}
