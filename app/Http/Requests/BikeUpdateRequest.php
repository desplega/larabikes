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
            'matricula' => "required_if:matriculada, 1",
        ] + parent::rules();
    }
}
