<?php

namespace App\Http\Requests;

use App\Http\Requests\BikeRequest;

class BikeUpdateRequest extends BikeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->bike->id;

        return [
            'matricula' => "required_if:matriculada, 1|
                nullable|
                regex:/^\d{4}[B-Z]{3}$/i|
                unique:bikes,matricula,$id",
        ] + parent::rules();
    }
}
