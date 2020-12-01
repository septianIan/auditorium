<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFormPeminjamanPegawai extends FormRequest
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
        $rule = [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'dariJam' => 'required',
            'sampaiJam' => 'required',
            'tglPinjam' => 'required',
            'kegiatan' => 'required',
        ];

        return $rule;
    }
}
