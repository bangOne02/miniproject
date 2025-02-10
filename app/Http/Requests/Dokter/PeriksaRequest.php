<?php

namespace App\Http\Requests\Dokter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PeriksaRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (!Request::routeIs('dokter.*')) {
            return false;
        }
        return Auth::check();
    }

    public function rules(): array
    {
        try{
            if (in_array($this->method(), ['POST'])) {
                $rules['rekam_id'] =  'required|max:1000';
                $rules['diagnosa'] =  'required|max:1000';
                $rules['deskripsi_tindakan'] =  'required|max:1000';
            } else {
                $rules['rekam_id'] =  'required|max:1000';
                $rules['diagnosa'] =  'required|max:1000';
                $rules['deskripsi_tindakan'] =  'required|max:1000';
            }
            return $rules;
        }catch (Exception $exception){
            abort('404','NOT FOUND');
        }
    }

    public function messages()
    {
        if (in_array($this->method(), ['POST'])) {
            $message = [
                'rekam_id.required' => "ID tidak ditemukan, silahkan refresh halaman atau relogin!",
                'rekam_id.max' => "ID tidak ditemukan, silahkan refresh halaman atau relogin!",
                'diagnosa.required' => "Diagnosa harus diisi!",
                'diagnosa.max' => "Panjang karakter maksimal adalah 1000 karakter!",
                'deskripsi_tindakan.required' => "Deskripsi Tindakan harus diisi!",
                'deskripsi_tindakan.max' => "Panjang karakter maksimal adalah 1000 karakter!",
            ];

        } else{
            $message = [
                'rekam_id.required' => "ID tidak ditemukan, silahkan refresh halaman atau relogin!",
                'rekam_id.max' => "ID tidak ditemukan, silahkan refresh halaman atau relogin!",
                'diagnosa.required' => "Diagnosa harus diisi!",
                'diagnosa.max' => "Panjang karakter maksimal adalah 1000 karakter!",
                'deskripsi_tindakan.required' => "Deskripsi Tindakan harus diisi!",
                'deskripsi_tindakan.max' => "Panjang karakter maksimal adalah 1000 karakter!",
            ];
        }
        return $message;
    }
}
