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
            'email' => 'formyapp2@gmail.com',
            'password' => '085722097053'
        ]);
    
        if ($response->failed()) {
            return false; 
        }
    
        $data = $response->json();
    
        if (!isset($data['access_token'])) {
            return false;
        }
    
        session(['bearer_token' => $data['access_token']]);
    
        return true; 
    }

    public function getMedicines()
    {
        $token = session('bearer_token');

        if (!$token) {
            $authResponse = $this->authenticate();

            if (!$authResponse) {
                return response()->json(['error' => 'Autentikasi gagal. Silakan coba lagi.'], 401);
            }

            $token = session('bearer_token');
        }

        $response = Http::withToken($token)->get("$this->apiBase/medicines");
        
        $medicines = $response->json()['medicines'] ?? [];
        return view('apotik.medicines',  array(
            'title' => "Dashboard Administrator | MiniProject v.1.0",
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ), compact('medicines'));
    }

    public function getMedicinePrice($medicineId)
    {
        $token = session('bearer_token');

        if (!$token) {
            if (!$this->authenticate()) {
                return response()->json(['error' => 'Autentikasi gagal. Silakan coba lagi.'], 401);
            }
            $token = session('bearer_token');
        }

        $response = Http::withToken($token)->get("$this->apiBase/medicines/$medicineId/prices");

        if ($response->failed()) {
            return response()->json(['error' => 'Gagal mengambil harga obat.'], $response->status());
        }

        $data = $response->json();
        $prices = $data['prices'] ?? [];

        $formattedPrices = array_map(function ($price) {
            return [
                'id' => $price['id'],
                'unit_price' => number_format($price['unit_price'], 0, ',', '.'),
                'start_date' => $price['start_date']['formatted'],
                'end_date' => $price['end_date']['formatted'],
            ];
        }, $prices);

        return response()->json([
            'medicine_id' => $medicineId,
            'prices' => $formattedPrices
        ]);
    }

    public function listPrescriptions()
    {
        $prescriptions = ResepDokter::whereNull('status') // Hanya ambil yang statusnya NULL
        ->get()
        ->groupBy('rekam_id');

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

    public function processCost(Request $request)
    {
        // Proses pembayaran resep
        $prescription_id = $request->input('prescription_id'); // Ambil rekam_id dari form

        // Update semua resep dokter yang memiliki rekam_id ini
        ResepDokter::where('id', $prescription_id)->update(['jumlah' => $request->input('harga')]);

        return redirect()->route('apoteker.prescriptions')->with('success', 'Update harga berhasil diproses.');
    }

    public function generateReceipt($id)
    {
       
        $prescription = ResepDokter::where('rekam_id', $id)->with('obat')->get();
        $data = [
            'transaction_id' => $id,
            'date' => now(),
            'patient_name' => Rekam::where('id', $id)->first()->pasien->nama_lengkap,
            'medicine' => $prescription->map(function ($item) {
                return [
                    'nama_obat' => $item->obat->name,
                    'jumlah' => $item->jumlah,
                    'harga' => $item->jumlah,
                    'dosis' => $item->dosis,
                    'aturan_pakai' => $item->aturan_pakai
                ];
            }),
            'total' => $prescription->sum(fn ($item) => $item->jumlah)
        ];

        $pdf = PDF::loadView('apotik.receipt', $data);
        return $pdf->download('resi_pembayaran.pdf');
    }
}
