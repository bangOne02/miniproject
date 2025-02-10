<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GolonganRequest extends FormRequest
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
            $rules['golongan_id'] =  'required|max:255';
        } else if(in_array($this->method(),['POST'])){
            $rules['name'] =  'required|max:255';
        } else {
            $rules['golongan_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'golongan_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'golongan_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'name.required' => "Nama Golongan harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        } else{
            $message = [
                'golongan_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'golongan_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
                'name.required' => "Nama Golongan harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        }
        return $message;
    }
}
