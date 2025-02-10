<?php
namespace App\Http\Requests\Pendaftaran;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (!Request::routeIs('front.*')) {
            return false;
        }
        return Auth::check();
    }

    public function rules(): array
    {
        if (in_array($this->method(), ['POST'])) {
            $rules['kode_pasien'] =  'required|max:255';
            $rules['nama_lengkap'] =  'required|max:255';
            $rules['tempat_lahir'] =  'required|max:255';
            $rules['tanggal_lahir'] =  'required|date';
            $rules['sex'] =  'required|max:1';
            $rules['agama'] =  'required|max:15';
            $rules['pendidikan'] =  'required|max:15';
            $rules['golongan_darah'] =  'required|max:2';
            $rules['phone'] =  'nullable|max:50';
            $rules['pekerjaan'] =  'nullable|max:255';
            $rules['alamat'] =  'nullable|max:255';
            $rules['tekanan_darah'] =  'required|max:3';
            $rules['rate'] =  'required|max:3';
            $rules['suhu_badan'] =  'required|max:3';
            $rules['berat_badan'] =  'required|max:3';
            $rules['tinggi_badan'] =  'required|max:3';
            $rules['keluhan_utama'] =  'required|max:255';
            $rules['dokter_id'] =  'required|max:255';
            return $rules;
        }
        abort('4014', 'NOT FOUND');

    }

    public function messages()
    {
        $message = [
            'kode_pasien.required' => "Kode Pasien harus diisi!",
            'kode_pasien.max' => "Panjang karakter maksimal adalah 255 karakter!",
            'nama_lengkap.required' => "Nama Lengkap Pasien harus diisi!",
            'nama_lengkap.max' => "Panjang karakter maksimal adalah 255 karakter!",
            'tempat_lahir.required' => "Tempat Lahir Pasien harus diisi!",
            'tempat_lahir.max' => "Panjang karakter maksimal adalah 255 karakter!",
            'tanggal_lahir.required' => "Tanggal Lahir Pasien harus diisi!",
            'tanggal_lahir.date' => "Silahkan masukkan format tanggal yang benar",
            'sex.required' => "Silahkan pilih jenis kelamin terlebih dahulu!",
            'sex.max' => "Silahkan pilih jenis kelamin terlebih dahulu!",
            'agama.required' => "Silahkan pilih Agama terlebih dahulu!",
            'agama.max' => "Silahkan pilih Agama terlebih dahulu!",
            'pendidikan.required' => "Silahkan pilih Pendidikan terakhir terlebih dahulu!",
            'pendidikan.max' => "Silahkan pilih Pendidikan terakhir terlebih dahulu!",
            'golongan_darah.required' => "Silahkan pilih Golongan Darah terlebih dahulu!",
            'golongan_darah.max' => "Silahkan pilih Golongan Darah terlebih dahulu!",
            'phone.max' => "Panjang karakter maksimal adalah 50 karakter!",
            'pekerjaan.max' => "Panjang karakter maksimal adalah 255 karakter!",
            'alamat.max' => "Panjang karakter maksimal adalah 255 karakter!",
            'tekanan_darah.required' => "Tekanan Darah harus diisi!",
            'tekanan_darah.max' => "Panjang karakter maksimal adalah 3 karakter!",
            'rate.required' => "Rate harus diisi!",
            'rate.max' => "Panjang karakter maksimal adalah 3 karakter!",
            'suhu_badan.required' => "Suhu badan harus diisi!",
            'suhu_badan.max' => "Panjang karakter maksimal adalah 3 karakter!",
            'berat_badan.required' => "Berat badan harus diisi!",
            'berat_badan.max' => "Panjang karakter maksimal adalah 3 karakter!",
            'tinggi_badan.required' => "Tinggi badan harus diisi!",
            'tinggi_badan.max' => "Panjang karakter maksimal adalah 3 karakter!",
            'keluhan_utama.required' => "Keluhan pasien harus diisi!",
            'keluhan_utama.max' => "Panjang karakter maksimal adalah 255 karakter!",
            'dokter_id.required' => "Silahkan Pilih Poliklinik Terlebih dahulu!",
            'dokter_id.max' => "Silahkan Pilih Poliklinik Terlebih dahulu!",
        ];
        return $message;
    }
}
