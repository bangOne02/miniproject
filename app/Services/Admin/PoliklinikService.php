<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\PoliklinikRequest;
use Illuminate\Http\Request;

interface PoliklinikService
{

    public function index(Request $request);

    public function save(PoliklinikRequest $request):void;

    public function update(PoliklinikRequest $request):void;

    public function delete(string $id):void;

}
