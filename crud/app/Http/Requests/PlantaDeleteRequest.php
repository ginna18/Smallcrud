<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;

class PlantaDeleteRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//determina si el usuario esta autorizado para realizar la peticion
    public function authorize()
    {
        return $this->user()->can('delete',$this->planta);
    }

    //mensaje en caso de que falle la autorizacion
    protected function failedAuthorization(){
        throw new AuthorizationException('no puedes eliminar una planta que no es tuya.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
