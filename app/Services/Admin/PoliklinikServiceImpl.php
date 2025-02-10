<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\PoliklinikRequest;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PoliklinikServiceImpl implements PoliklinikService
{

    public function index(Request $request)
    {
        $poliklinik = Poliklinik::orderBy('name', 'ASC')->get();
        return DataTables::of($poliklinik)
            ->addIndexColumn()
            ->editColumn('name', function ($request) {
                return ucfirst($request->name);
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $btn = "<button class=\"btn btn-sm btn-primary open-edit\" data-name =\" $row->name \" data-id=\"$id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"><i class=\"fas fa-edit\"></i> Edit</button>";
                $btn = $btn . " <a href=\"#\" class=\"btn btn-sm btn-danger ml-auto open-hapus\" data-id=\"$id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"><i class=\"fas fa-trash\"></i> Delete</i></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(PoliklinikRequest $request): void
    {
        $poliklinik = new Poliklinik();
        $poliklinik->name = $request->name;
        $poliklinik->save();
    }

    public function update(PoliklinikRequest $request): void
    {
        $poliklinik = Poliklinik::findOrFail(base64_decode($request->poliklinik_id));
        Poliklinik::where('id', $poliklinik->id)->update([
            'name' => $request->name
        ]);
    }

    public function delete(string $id): void
    {
        $poliklinik = Poliklinik::findOrFail($id);
        Poliklinik::where('id', $poliklinik->id)->delete();
    }


}
