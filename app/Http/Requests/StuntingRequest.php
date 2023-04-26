<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StuntingRequest extends FormRequest
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
            'id_balita' => 'required|integer|exists:balita,id',
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
            'hari' => 'required|integer',
            'tgl_pengukuran' => 'required|date',
            'berat' => 'required|string|max:255',
            'tinggi' => 'required|string|max:255',
            'bb_per_u' => 'required|string|max:255',
            'zs_bb_per_u' => 'required|string|max:255',
            'tb_per_u' => 'required|string|max:255',
            'zs_tb_per_u' => 'required|string|max:255',
            'bb_per_tb' => 'required|string|max:255',
            'zs_bb_per_tb' => 'required|string|max:255',
            'naik_berat_badan' => 'required|string|max:255',
            'pmt_diterima' => 'required|string|max:255',
            'jml_vit_a' => 'required|string|max:255',
            'kpsp' => 'required|string|max:255',
            'kia' => 'required|string|max:255',
        ];
    }
}
