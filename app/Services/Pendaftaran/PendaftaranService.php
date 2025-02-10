<?php

namespace App\Services\Pendaftaran;

use App\Http\Requests\Dokter\PeriksaRequest;
use App\Http\Requests\Pendaftaran\PasienRequest;
use Illuminate\Http\Request;

interface PendaftaranService
{
    public function save(PasienRequest $request, string $createdBy):void;

    public function update(PasienRequest $request, int $id , string $createdBy):void;

    public function getDataPasien(Request $request);

    public function save_pemeriksaan(PeriksaRequest $request):void;
}
