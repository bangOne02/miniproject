<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\GolonganRequest;
use App\Models\Golongan_obat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GolonganServiceImpl implements GolonganService
{

    public function index(Request $request)
    {
        $golongan = Golongan_obat::orderBy('name', 'ASC')->get();
        return DataTables::of($golongan)
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

    public function save(GolonganRequest $request): void
    {
        $golongan = new Golongan_obat();
        $golongan->name = $request->name;
        $golongan->save();
    }

    public function update(GolonganRequest $request): void
    {
        $golongan = Golongan_obat::findOrFail(base64_decode($request->golongan_id));
        Golongan_obat::where('id', $golongan->id)->update([
            'name' => $request->name
        ]);
    }

    public function delete(int $id): void
    {
        $golongan = Golongan_obat::findOrFail($id);
        Golongan_obat::where('id', $golongan->id)->delete();
    }


}
