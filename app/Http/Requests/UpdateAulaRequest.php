<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateAulaRequest extends FormRequest
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

        $id = $this->route('aula');

        return [
            'nombre' => 'required|unique:aulas,nombre,' . $id,
            'edificio' => 'required',
            'piso' => 'required',
            'proyector' => ['required', 'in:Si,No'],
            'aire' => ['required', 'in:Si,No'], 
            'cantidad_pc' => 'required',
            'capacidad' => 'required',
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
