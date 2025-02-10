<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MedicineService
{
    protected $apiUrl = "http://recruitment.rsdeltasurya.com/api/v1/";

    public function authenticate($email, $password)
    {
        $response = Http::post($this->apiUrl . "auth", [
            'email' => $email,
            'password' => $password,
        ]);

        return $response->json();
    }

    public function getMedicines($token)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
        ])->get($this->apiUrl . "medicines");

        return $response->json();
    }

    public function getMedicinePrice($token, $medicineId)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
        ])->get($this->apiUrl . "medicines/{$medicineId}/prices");

        return $response->json();
    }
}
