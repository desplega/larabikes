<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateBikeRequest extends ApiCreateBikeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('bike');

        return [
            'matricula' => "required_if:matriculada,1|
                nullable|
                regex:/^\d{4}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/i|
                unique:bikes,matricula,$id"
        ] + parent::rules();
    }
}
