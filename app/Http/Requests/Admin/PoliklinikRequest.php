<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliklinikRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (!Request::routeIs('adm.*')) {
            return false;
        }
        return Auth::check();
    }

    public function rules(): array
    {
        if (in_array($this->method(), ['DELETE'])) {
            $rules['poliklinik_id'] =  'required|max:255';
        } else if(in_array($this->method(),['POST'])){
            $rules['name'] =  'required|max:255';
        } else {
            $rules['poliklinik_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'poliklinik_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'poliklinik_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'name.required' => "Nama Poliklinik harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        } else{
            $message = [
                'poliklinik_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'poliklinik_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
                'name.required' => "Nama Poliklinik harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        }
        return $message;
    }
}
