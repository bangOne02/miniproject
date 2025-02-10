<?php

namespace app\Services\Pemeriksaan;

use App\Http\Requests\Dokter\PeriksaRequest;

interface PemeriksaanService
{
    public function save(PeriksaRequest $request):void;

}
