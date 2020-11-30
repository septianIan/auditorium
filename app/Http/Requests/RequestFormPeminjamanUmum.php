<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFormPeminjamanUmum extends FormRequest
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
        $rules = [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'dariJam' => 'required',
            'sampaiJam' => 'required',
            'tglPinjam' => 'required',
            'kegiatan' => 'required',
        ];

        return $rules;
    }
}
