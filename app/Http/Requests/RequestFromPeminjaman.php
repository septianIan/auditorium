<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFromPeminjaman extends FormRequest
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
            'nim' => 'required',
            'nama' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'noTelp' => 'required',
            'dariJam' => 'required',
            'sampaiJam' => 'required',
            'tglPinjam' => 'required',
            'kegiatan' => 'required',
        ];

        // jika request store/POST
        if ($this->getMethod() == "POST") {
            //tambahkan array rules
            $rules += ['image' => 'required|image'];
        }

        return $rules;
    }
}
