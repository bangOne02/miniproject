<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PoliklinikRequest;
use App\Services\Admin\PoliklinikService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PoliklinikController extends Controller
{

    protected $users;
    protected PoliklinikService $poliklinikService;

    public function __construct(PoliklinikService $poliklinikService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->poliklinikService = $poliklinikService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->poliklinikService->index($request);
        }

        return view('admin.poliklinik', array(
            'title' => "Dashboard Administrator | MyKlinik v.1.0",
            'firstMenu' => 'poliklinik',
            'secondMenu' => 'poliklinik',
        ));
    }

    private function handleTransaction(callable $callback, $successMessage,$status)
    {
        DB::beginTransaction();
        try{
            $callback();
            DB::commit();
            return redirect(route('adm.poli'))->with([$status => $successMessage]);
        }catch (Exception $e){
            DB::rollback();
            return redirect(route('adm.poli'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(PoliklinikRequest $request)
    {
        $request->validated();
        return $this->handleTransaction(
            fn() => $this->poliklinikService->save($request),
            "Data Poliklinik berhasil ditambahkan!","success"
        );
    }

    public function update(PoliklinikRequest $request)
    {
        $request->validated();
        return $this->handleTransaction(
            fn() => $this->poliklinikService->update($request),
            "Data Poliklinik berhasil diperbaharui!","success"
        );
    }

    public function destroy(PoliklinikRequest $request)
    {
        $request->validated();
        $id = base64_decode($request->poliklinik_id);
        return $this->handleTransaction(
            fn() => $this->poliklinikService->delete($id),
            "Data Poliklinik berhasil dihapus!","delete"
        );
    }
}
