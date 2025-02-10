<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dokter\PeriksaRequest;
use App\Models\Karyawans;
use App\Models\Pasien;
use App\Models\Rekam;
use App\Models\ResepDokter;
use App\Models\User;
use App\Models\Obat;
use App\Models\BerkasPemeriksaan;


use App\Services\Pendaftaran\PendaftaranService;
use app\Services\Pendaftaran\RekamRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class DataRekamController extends Controller
{
    protected User $users;
    protected int $totalSelesai = 0;

    protected PendaftaranService $pendaftaranService;
    protected int $dokterID;

    public function __construct(PendaftaranService $pendaftaranService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            $this->dokterID = Karyawans::with('dokter')->where('user_id', $this->users->id)->first()->dokter->id;
            return $next($request);
        });
        $this->pendaftaranService = $pendaftaranService;
    }

    public function index()
    {
        $rekam = Rekam::with('pasien', 'antrian')->today()->where('dokter_id', $this->dokterID)->get()->sortBy('antrian');
        $this->totalSelesai =  $rekam->where('status','2')->count();
        $dataPasien= $rekam->whereIn('status',['0','1']);
        return view('dokter.pemeriksaan', array(
            'title' => "Dashboard Administrator | MiniProject v.1.0",
            'firstMenu' => 'pemeriksaan',
            'secondMenu' => 'pemeriksaan',
            'dataRekam' => $dataPasien,
            'totalSelesai' => $this->totalSelesai
        ));
    }

    public function detail_pasien($id)
    {
        try {
            $idPasien = base64_decode($id);
            $pasien = Pasien::findOrFail($idPasien);
            return view('dokter.detailpasien', array(
                'title' => "Dashboard Administrator | MiniProject v.1.0",
                'firstMenu' => 'pemeriksaan',
                'secondMenu' => 'pemeriksaan',
                'dataPasien' => $pasien
            ));
        } catch (Exception $e) {
            abort(404);
        }

    }

    public function proses()
    {
        try {
            $rekam = Rekam::with('pasien')->where('dokter_id', $this->dokterID)->today()->ongoing()->orderBy('id', 'ASC')->get();
            if($rekam->count() > 0){
                $dataPasien = $rekam->first();
                $cekOngoing = $rekam->where('status', '1');

                if ($cekOngoing->count() > 0) {
                    $dataPasien =  $cekOngoing->first();
                }

                if ($cekOngoing->count() == 0) {
                    $rekam->first()->pushStatus("1");
                }

                $obats = Obat::all(); // atau sesuaikan query-nya jika diperlukan

                return view('dokter.detailpemeriksaan', array(
                    'title' => "Dashboard Administrator | MiniProject v.1.0",
                    'firstMenu' => 'pemeriksaan',
                    'secondMenu' => 'pemeriksaan',
                    'dataPasien' => $dataPasien,
                    'obats' => $obats
                ));
            }
            return redirect(route('dokter.pemeriksaan'))->with(['delete' => "Belum ada Pasien hari ini!"]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function selesai_periksa(PeriksaRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {

            $this->pendaftaranService->save_pemeriksaan($request);

            // Simpan file jika ada
            $file = $request->file('berkas_pemeriksaan');
            if ($file) {
                $path = $file->store('berkas_pemeriksaan', 'public');
                echo "34dddd34"; // Cek apakah tampil
                BerkasPemeriksaan::create([
                    'rekam_id' => $request->rekamid,
                    'file_path' => $path,
                ]);
            }

            $resep = [];
            if (!empty($request->obat_id) && !empty($request->aturan_pakai)) {
                foreach ($request->obat_id as $index => $obat_id) {
                    if (!empty($obat_id) && !empty($request->aturan_pakai[$index])) {
                        $resep[] = [
                            'obat_id' => $obat_id,
                            'aturan_pakai' => $request->aturan_pakai[$index],
                        ];
                    }
                }
            }
            
            if (!empty($resep)) {
                foreach ($resep as $data) {
                    DB::table('resep_dokter')->insert([
                        'rekam_id' => $request->rekamid,
                        'obat_id' => $data['obat_id'],
                        'aturan_pakai' => $data['aturan_pakai'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            
            DB::commit();
            return redirect(route('dokter.pemeriksaan'))->with(['success' => "Data berhasil disimpan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('dokter.pemeriksaan'))->withErrors(['error' => $e->getMessage()]);
        }
    }

}
