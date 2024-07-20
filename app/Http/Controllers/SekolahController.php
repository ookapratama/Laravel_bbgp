<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function getSekolahs(Request $request)
    {
        $perPage = $request->input('per_page', 500); // Items per page, default to 500
        $page = $request->input('page', 1); // Current page
        $search = $request->input('q', ''); // Search term

        $query = Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
            ->when($search, function ($query, $search) {
                return $query->where('nama_sekolah', 'like', "%$search%")
                    ->orWhere('npsn_sekolah', 'like', "%$search%");
            });

        $sekolahs = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($sekolahs);
    }
}
