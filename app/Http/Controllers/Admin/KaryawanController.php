<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KaryawanRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Admin\KaryawanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class KaryawanController extends Controller
{

    protected User $users;
    protected KaryawanService $karyawanService;

    public function __construct(KaryawanService $karyawanService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->karyawanService = $karyawanService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->karyawanService->index($request);
        }

        return view('admin.karyawan.index', array(
            'title' => "Dashboard Administrator | MiniProject v.1.0",
            'firstMenu' => 'karyawan',
            'secondMenu' => 'karyawan',
        ));
    }

    public function store(KaryawanRequest $request)
    {
        $request->validated();
        return $this->handleTransaction(
            fn() => $this->karyawanService->save($request),
            "Data Karyawan berhasil ditambahkan!","success",true
        );
    }

    public function create()
    {
        $role = Role::karyawan()->get();
        return view('admin.karyawan.add', array(
            'title' => "Dashboard Administrator | MiniProject v.1.0",
            'firstMenu' => 'karyawan',
            'secondMenu' => 'karyawan',
            'dataRole' => $role
        ));
    }

    public function edit(string $id = null)
    {
        if ($id != null) {
            try{
                $user = User::with('karyawan')->findOrFail(decrypt($id));
                $role = Role::karyawan()->get();
                return view('admin.karyawan.edit', array(
                    'title' => "Dashboard Administrator | MiniProject v.1.0",
                    'firstMenu' => 'karyawan',
                    'secondMenu' => 'karyawan',
                    'dataRole' => $role,
                    'dataKaryawan' => $user
                ));
            }catch (Exception $e){
                abort('404',$e->getMessage());
            }
        }
        abort('404',"NOT FOUND");
    }

    public function update(KaryawanRequest $request)
    {
        $request->validated();
        return  $this->handleTransaction(
            fn() => $this->karyawanService->update($request),
            "Data Karyawan berhasil diperbaharui!","success",false,$request->user_id
        );
    }

    public function destroy(KaryawanRequest $request)
    {
        $request->validated();
        return  $this->handleTransaction(
            fn() => $this->karyawanService->delete($request->user_id),
            "Data Karyawan berhasil dihapus!","delete",true
        );
    }

    private function handleTransaction(callable $callback, string $successMessage, string $status , bool $isSaved , string $id = null)
    {
        DB::beginTransaction();
        try{
            $callback();
            DB::commit();
            if(!$isSaved && $id != null){
                return redirect(route('adm.karyawan.edit',$id))->with([$status => $successMessage]);
            }
            return redirect(route('adm.karyawan'))->with([$status => $successMessage]);
        }catch (Exception $e){
            DB::rollback();
            return redirect(route('adm.karyawan'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
