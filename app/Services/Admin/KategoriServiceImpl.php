<?php

namespace App\Services\Admin;

use App\Models\Kategori_obat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriServiceImpl implements KategoriService
{

    public function index(Request $request)
    {
        $kategori = Kategori_obat::orderBy('name', 'ASC')->get();
        return DataTables::of($kategori)
            ->addIndexColumn()
            ->editColumn('name', function ($request) {
                return ucfirst($request->name);
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $btn = "<button class=\"btn btn-sm btn-primary open-edit\" data-name =\" $row->name \" data-id=\"$id\"data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"><i class=\"fas fa-edit\"></i> Edit</button>";
                $btn = $btn . " <a href=\"#\" class=\"btn btn-sm btn-danger ml-auto open-hapus\" data-id=\"$id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"><i class=\"fas fa-trash\"></i> Delete</i></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(Request $request): void
    {
        $kategori = new Kategori_obat();
        $kategori->name = $request->name;
        $kategori->save();
    }

    public function update(Request $request): void
    {
        $kategori = Kategori_obat::findOrFail(base64_decode($request->kategori_id));
        Kategori_obat::where('id', $kategori->id)->update([
            'name' => $request->name
        ]);
    }

    public function delete(int $id): void
    {
        $kategori = Kategori_obat::findOrFail($id);
        Kategori_obat::where('id', $kategori->id)->delete();
    }


}
