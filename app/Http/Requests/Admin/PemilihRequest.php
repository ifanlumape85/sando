<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PemilihRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_tps' => 'required|integer|exists:tps,id',
            'id_kelurahan' => 'required|integer|exists:kelurahan,id',
            'nik' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jk' => 'required',
            'alamat' => 'required|string|max:255',
            // 'photo' => 'required|string|max:255',
        ];
    }
}
