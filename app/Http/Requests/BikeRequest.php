<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRequest extends FormRequest
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
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'required_with:matricula',
            'matricula' => 'required_if:matriculada,1|
                nullable|
                regex:/^\d{4}[B-Z]{3}$/i|
                unique:bikes',
            'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048',
        ];
    }

    /**
     * Return the messages
     */
    public function messages()
    {
        return [
            'precio.numeric' => 'El precio debe ser un número',
            'precio.min' => 'El precio debe ser mayor o igual a cero',
            'kms.integer' => 'Los kilómetros deben ser un número',
            'kms.min' => 'Los kilómetros deben ser 0 o más',
            'matricula.required_if' => 'La matrícula es obligatoria si la moto está matriculada',
            'matricula.unique' => 'Ya existen una moto con la misma matrícula',
            'matricula.regex' => 'La matricula debe contener cuatro dígitos y tres letras',
            'color.regex' => 'El color debe estar en formato RGB HEX comenzando por #',
            'imagen.image' => 'El fichero debe ser una imagen',
            'imagen.mimes' => 'La imagen debe ser de tipo jpg, png, gif o webp',
        ];
    }
}
