<?php

namespace App\Http\Controllers\Apotik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\ResepDokter;
use App\Models\Rekam;

class ApotekerController extends Controller
{
    private $apiBase = 'http://recruitment.rsdeltasurya.com/api/v1';
    
    public function authenticate()
    {
        $response = Http::post("$this->apiBase/auth", [
            'email' => 'arfi.afianto@rsdeltasurya.com',
            'password' => '081234567890'
        ]);

        $data = $response->json();
        session(['bearer_token' => $data['access_token']]);
        return redirect()->route('apoteker.medicines');
    }

    public function getMedicines()
    {
        $token = session('bearer_token');
        $response = Http::withToken($token)->get("$this->apiBase/medicines");
        
        $medicines = $response->json()['medicines'] ?? [];
        return view('apoteker.medicines', compact('medicines'));
    }

    public function getMedicinePrice($medicineId)
    {
        $token = session('bearer_token');
        $response = Http::withToken($token)->get("$this->apiBase/medicines/$medicineId/prices");
        
        $prices = $response->json()['prices'] ?? [];
        return response()->json($prices);
    }

    public function listPrescriptions()
    {
        // $prescriptions = ResepDokter::all();
        // return view('apotik.prescriptions', compact('prescriptions'));
        // $prescriptions = ResepDokter::all()->groupBy('rekam_id');
        $prescriptions = ResepDokter::whereNull('status') // Hanya ambil yang statusnya NULL
        ->get()
        ->groupBy('rekam_id');

        // dump($prescriptions);

        return view('apotik.prescriptions', array(
            'title' => "Dashboard Administrator | MiniProject v.1.0",
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ), ['groupedPrescriptions' => $prescriptions]);
    }

    public function processPayment(Request $request)
    {
        // Proses pembayaran resep
        $rekam_id = $request->input('rekam_id'); // Ambil rekam_id dari form

        // Update semua resep dokter yang memiliki rekam_id ini
        ResepDokter::where('rekam_id', $rekam_id)->update(['status' => 'paid']);

        return redirect()->route('apoteker.prescriptions')->with('success', 'Pembayaran berhasil diproses.');
    }

    public function generateReceipt($id)
    {
        // $prescription = ResepDokter::findOrFail($id);

        // // Ambil semua obat yang memiliki rekam_id sesuai dengan $id
        // $medicines = ResepDokter::where('rekam_id', $id)->get();

        // dump($prescription);
        // dump($medicines);
        // $prescription = ResepDokter::findOrFail($id);

        // $data = [
        //     'transaction_id' => $id,
        //     'date' => now(),
        //     'patient_name' => $prescription->nama_pasien,
        //     'medicine' => $prescription->obat,
        //     'total' => 50000 // Contoh total harga, bisa diambil dari tabel harga obat
        // ];
        
        // $pdf = PDF::loadView('apotik.receipt', $data);
        // return $pdf->download('resi_pembayaran.pdf');
        $prescription = ResepDokter::where('rekam_id', $id)->with('obat')->get();
        $data = [
            'transaction_id' => $id,
            'date' => now(),
            'patient_name' => Rekam::where('id', $id)->first()->pasien->nama_lengkap,
            'medicine' => $prescription->map(function ($item) {
                return [
                    'nama_obat' => $item->obat->name,
                    'jumlah' => $item->jumlah,
                    'harga' => $item->obat->price,
                    'dosis' => $item->dosis,
                    'aturan_pakai' => $item->aturan_pakai
                ];
            }),
            'total' => $prescription->sum(fn ($item) => $item->jumlah * $item->obat->price)
        ];

        $pdf = PDF::loadView('apotik.receipt', $data);
        return $pdf->download('resi_pembayaran.pdf');
    }
}
