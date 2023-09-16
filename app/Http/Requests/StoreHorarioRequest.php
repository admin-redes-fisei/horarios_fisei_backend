<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class StoreHorarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'aula_id' => 'required',
            'docente_id' => 'required',
            'actividad_id' => 'required',
            'paralelo_id' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'numero_dia' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de Validación',
            'errores' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
        
    }
}
