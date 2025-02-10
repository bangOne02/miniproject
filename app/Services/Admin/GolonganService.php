<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\GolonganRequest;
use Illuminate\Http\Request;

interface GolonganService
{

    public function index(Request $request);

    public function save(GolonganRequest $request):void;

    public function update(GolonganRequest $request):void;

    public function delete(int $id):void;

}
