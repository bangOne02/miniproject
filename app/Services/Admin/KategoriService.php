<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;

interface KategoriService
{

    public function index(Request $request);

    public function save(Request $request):void;

    public function update(Request $request):void;

    public function delete(int $id):void;
}
