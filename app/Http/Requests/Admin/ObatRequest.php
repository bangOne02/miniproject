<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObatRequest extends FormRequest
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
            $rules['obat_id'] =  'required|max:255';
        } else if(in_array($this->method(),['POST'])){
            $rules['name'] =  'required|max:255';
            $rules['golongan_id'] =  'required|max:255';
            $rules['kategori_id'] =  'required|max:255';
            $rules['produsen_id'] =  'required|max:255';
            $rules['type'] =  'required|max:255';
            $rules['price'] =  'required|numeric';
            $rules['stock'] =  'required|numeric';
        } else {
            $rules['obat_id'] =  'required|max:255';
            $rules['kategori_id'] =  'required|max:255';
            $rules['golongan_id'] =  'required|max:255';
            $rules['produsen_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
            $rules['type'] =  'required|max:255';
            $rules['price'] =  'required|numeric';
            $rules['stock'] =  'required|numeric';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'obat_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'obat_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'name.required' => "Nama Obat harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'golongan_id.required' => "Silahkan pilih Golongan terlebih dahulu!",
                'golongan_id.max' => "Silahkan pilih Golongan terlebih dahulu!",
                'kategori_id.required' => "Silahkan pilih Kategori terlebih dahulu!",
                'kategori_id.max' => "Silahkan pilih Kategori terlebih dahulu!",
                'produsen_id.required' => "Silahkan pilih Produsen terlebih dahulu!",
                'produsen_id.max' => "Silahkan pilih Produsen terlebih dahulu!",
                'type.required' => "Silahkan pilih Tipe obat terlebih dahulu!",
                'type.max' => "Silahkan pilih Tipe obat terlebih dahulu!",
                'price.required' => "Harga Obat harus diisi!",
                'price.numeric' => "Silahkan masukkan angka!",
                'stock.required' => "Jumlah Stock Obat harus diisi!",
                'stock.numeric' => "Silahkan masukkan angka!",
            ];
        } else{
            $message = [
                'obat_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'obat_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
                'kategori_id.required' => "Silahkan pilih Kategori terlebih dahulu!",
                'kategori_id.max' => "Silahkan pilih Kategori terlebih dahulu!",
                'golongan_id.required' => "Silahkan pilih Golongan terlebih dahulu!",
                'golongan_id.max' => "Silahkan pilih Golongan terlebih dahulu!",
                'produsen_id.required' => "Silahkan pilih Produsen terlebih dahulu!",
                'produsen_id.max' => "Silahkan pilih Produsen terlebih dahulu!",
                'name.required' => "Nama Obat harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
                'type.required' => "Silahkan pilih Tipe obat terlebih dahulu!",
                'type.max' => "Silahkan pilih Tipe obat terlebih dahulu!",
                'price.required' => "Harga Obat harus diisi!",
                'price.numeric' => "Silahkan masukkan angka!",
                'stock.required' => "Jumlah Stock Obat harus diisi!",
                'stock.numeric' => "Silahkan masukkan angka!",
            ];
        }
        return $message;
    }
}
