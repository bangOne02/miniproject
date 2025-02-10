<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GolonganRequest;
use App\Models\User;
use App\Services\Admin\GolonganService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GolonganController extends Controller
{

    protected User $users;
    protected GolonganService $golonganService;

    public function __construct(GolonganService $golonganService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->golonganService = $golonganService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->golonganService->index($request);
        }

        return view('admin.golongan', array(
            'title' => "Dashboard Administrator | MyKlinik v.1.0",
            'firstMenu' => 'myData',
            'secondMenu' => 'golongan',
        ));
    }

    public function store(GolonganRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $this->golonganService->save($request);
            DB::commit();
            return redirect(route('adm.golongan'))->with(['success' => "Data Golongan berhasil ditambahkan!"]);
        }catch (Exception $e){
            DB::rollback();
            return redirect(route('adm.golongan'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(GolonganRequest $request)
    {
        DB::beginTransaction();
        try{
            $this->golonganService->update($request);
            DB::commit();
            return redirect(route('adm.golongan'))->with(['success' => "Data Golongan berhasil diperbaharui!"]);
        }catch (Exception $e){
            DB::rollback();
            return redirect(route('adm.golongan'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(GolonganRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $id = base64_decode($request->golongan_id);
            $this->golonganService->delete($id);
            DB::commit();
            return redirect(route('adm.golongan'))->with(['delete' => "Data Golongan berhasil dihapus!"]);
        }catch (Exception $e){
            DB::rollback();
            return redirect(route('adm.golongan'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
