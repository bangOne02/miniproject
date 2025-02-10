<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\ObatRequest;
use App\Models\Golongan_obat;
use App\Models\Kategori_obat;
use App\Models\Obat;
use App\Models\Produsen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ObatServiceImpl implements ObatService
{

    public function index(Request $request)
    {
        $obat = Obat::with('golongan','produsen')->orderBy('id', 'DESC')->get();
        return DataTables::of($obat)
            ->addIndexColumn()
            ->editColumn('name', fn($request) => ucfirst($request->name))
            ->editColumn('created_at', fn($request) => $request->created_at->format('d-m-Y H:i:s'))
            ->editColumn('golongan', fn($request) => strtoupper($request->golongan->name))
            ->editColumn('produsen', fn($request) => strtoupper($request->produsen->name))
            ->editColumn('kategori', fn($request) => strtoupper($request->kategori->name))
            ->editColumn('code', fn($request) => strtoupper($request->code))
            ->editColumn('price', fn($request) => "Rp. ".$request->price)
            ->addColumn('action', fn($row) => $this->createActionButtons($row))
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(ObatRequest $request): void
    {

        $relatedEntities = $this->findRelatedEntities([$request->kategori_id,$request->golongan_id,$request->produsen_id]);
        $obat = new Obat([
            'kategoriobat_id' => $relatedEntities['kategori']->id,
            'golonganobat_id' => $relatedEntities['golongan']->id,
            'produsen_id' => $relatedEntities['produsen']->id,
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        $obat->save();
    }

    public function update(ObatRequest $request): void
    {
        $obat = Obat::findOrFail(decrypt($request->obat_id));
        $relatedEntities = $this->findRelatedEntities([$request->kategori_id,$request->golongan_id,$request->produsen_id]);
        Obat::where('id', $obat->id)->update([
            'kategoriobat_id' => $relatedEntities['kategori']->id,
            'golonganobat_id' => $relatedEntities['golongan']->id,
            'produsen_id' =>  $relatedEntities['produsen']->id,
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
    }

    public function delete(string $id): void
    {
        $obat = Obat::findOrFail($id);
        Obat::where('id', $obat->id)->delete();
    }

    private function createActionButtons($row): string
    {
        $id = encrypt($row->id);
        $idBase64 = base64_encode($row->id);
        $url = route('adm.obat.edit', $id);
        $editButton = "<a href=\"$url\"><button class=\"btn btn-sm btn-primary\"><i class=\"fas fa-edit\"></i> Edit</button></a>";
        $deleteButton = "<a href=\"#\" class=\"btn btn-sm btn-danger ml-auto open-hapus\" data-id=\"$idBase64\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"><i class=\"fas fa-trash\"></i> Delete</i></a>";
        return $editButton . " " . $deleteButton;
    }

    private function findRelatedEntities(array $id): array
    {
        return [
            'kategori' => Kategori_obat::findOrFail(base64_decode($id[0])),
            'golongan' => Golongan_obat::findOrFail(base64_decode($id[1])),
            'produsen' => Produsen::findOrFail(base64_decode($id[2]))
        ];
    }
}
