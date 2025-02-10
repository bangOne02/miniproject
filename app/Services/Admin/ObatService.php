<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\ObatRequest;
use Illuminate\Http\Request;

interface ObatService
{

    public function index(Request $request);

    public function save(ObatRequest $request):void;

    public function update(ObatRequest $request):void;

    public function delete(string $id):void;
}
