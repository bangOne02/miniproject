<?php

namespace app\Services\Pemeriksaan;

use App\Http\Requests\Dokter\PeriksaRequest;

class PemeriksaanServiceImpl implements PemeriksaanService
{
    public function save(PeriksaRequest $request): void
    {
        echo "testing";
    }

}
