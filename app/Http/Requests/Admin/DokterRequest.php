<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DokterRequest extends FormRequest
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
        try{
            if (in_array($this->method(), ['DELETE'])) {
                $rules['user_id'] =  'required|max:255';
            } else if(in_array($this->method(),['POST'])){
                $rules['nip'] =  'required|max:255';
                $rules['izin'] =  'required|max:255';
                $rules['email'] =  'required|email|unique:users,email';
                $rules['name'] =  'required|max:255';
                $rules['poli_id'] =  'required|max:255';
                $rules['sex'] =  'required|max:1';
                $rules['phone'] =  'nullable|max:255';
                $rules['alamat'] =  'nullable|max:255';
            } else {
                $rules['user_id'] =  'required|max:255';
                $rules['nip'] =  'required|max:255';
                $rules['izin'] =  'required|max:255';
                $rules['email'] =
                    [
                        'required',
                        'email',
                        Rule::unique('users','email')->ignore(decrypt($this->user_id)),
                    ];
                $rules['name'] =  'required|max:255';
                $rules['poli_id'] =  'required|max:255';
                $rules['sex'] =  'required|max:1';
                $rules['phone'] =  'nullable|max:255';
                $rules['alamat'] =  'nullable|max:255';
            }
            return $rules;
        }catch (\Exception $exception){
            abort('404','NOT FOUND');
        }
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'user_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'user_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'nip.required' => "NIP harus diisi!",
                'nip.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'izin.required' => "Nomor Izin Dinas harus diisi!",
                'izin.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'email.required' => "Email harus diisi!",
                'email.email' => "Silahkan isi dengan alamat email yang benar!",
                'email.unique' => "Alamat email sudah terdaftar!",
                'name.required' => "Nama Lengkap harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'poli_id.required' => "Silahkan pilih Poliklinik terlebih dahulu!",
                'poli_id.max' => "Silahkan pilih Poliklinik terlebih dahulu!",
                'sex.required' => "Silahkan pilih Jenis Kelamin terlebih dahulu!",
                'sex.max' => "Silahkan pilih Jenis Kelamin terlebih dahulu!",
                'phone.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'alamat.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        } else{
            $message = [
                'nip.required' => "NIP harus diisi!",
                'nip.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'email.required' => "Email harus diisi!",
                'email.email' => "Silahkan isi dengan alamat email yang benar!",
                'email.unique' => "Alamat email sudah terdaftar!",
                'name.required' => "Nama Lengkap harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'poli_id.required' => "Silahkan pilih Poliklinik terlebih dahulu!",
                'poli_id.max' => "Silahkan pilih Poliklinik terlebih dahulu!",
                'sex.required' => "Silahkan pilih Jenis Kelamin terlebih dahulu!",
                'sex.max' => "Silahkan pilih Jenis Kelamin terlebih dahulu!",
                'phone.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'alamat.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        }
        return $message;
    }
}
