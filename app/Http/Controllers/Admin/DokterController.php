<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DokterRequest;
use App\Models\Poliklinik;
use App\Models\Role;
use Exception;
use App\Models\User;
use App\Services\Admin\KaryawanService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{

    protected User $users;
    protected KaryawanService $karyawanService;
    protected Collection $poliklinik;

    public function __construct(KaryawanService $karyawanService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->karyawanService = $karyawanService;
        $this->poliklinik = Poliklinik::orderBy('name')->get();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->karyawanService->index_dokter($request);
        }

        return view('admin.dokter.index', array(
            'title' => "Dashboard Administrator | MyKlinik v.1.0",
            'firstMenu' => 'karyawan',
            'secondMenu' => 'dokter',
        ));
    }

    public function create()
    {
        return view('admin.dokter.add', array(
            'title' => "Dashboard Administrator | MyKlinik v.1.0",
            'firstMenu' => 'karyawan',
            'secondMenu' => 'dokter',
            'dataPoliklinik' => $this->poliklinik
        ));
    }

    public function store(DokterRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->karyawanService->save_dokter($request);
            DB::commit();
            return redirect(route('adm.dokter'))->with(['success' => "Data Dokter berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.dokter'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(string $id = null)
    {
        if ($id != null) {
            try{
                $user = User::with('karyawandokter')->findOrFail(decrypt($id));
                return view('admin.dokter.edit', array(
                    'title' => "Dashboard Administrator | MyKlinik v.1.0",
                    'firstMenu' => 'karyawan',
                    'secondMenu' => 'dokter',
                    'dataPoliklinik' => $this->poliklinik,
                    'dataDokter' => $user
                ));
            }catch (Exception $e){
                abort('404',"NOT FOUND");
            }
        }
        abort('404',"NOT FOUND");
    }

    public function update(DokterRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->karyawanService->update_dokter($request);
            DB::commit();
            return redirect(route('adm.dokter.edit',$request->user_id))->with(['success' => "Data Dokter berhasil diperbaharui!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.dokter'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(DokterRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->karyawanService->delete($request->user_id);
            DB::commit();
            return redirect(route('adm.dokter'))->with(['delete' => "Data Dokter berhasil dihapus!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.dokter'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
