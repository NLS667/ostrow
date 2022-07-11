<?php

namespace App\Http\Requests\Backend\Model;

use App\Http\Requests\Request;

/**
 * Class StoreModelRequest.
 */
class StoreModelRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-model');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:191',
            'description'       => 'max:191',
            'serial_number'     => 'max:191',
            'producer'          => 'required',
        ];
    }

    /**
     * Get the validation massages that apply to the rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'producer.required' => 'Musisz wybrać Producenta.',
            'name.required' => 'Nazwa Modelu nie może być pusta.',
            'name.max' => 'Nazwa jest za długa (max 191 znaków).',
            'description.max' => 'Opis jest za długi (max 191 znaków).',
            'serial_number.max' => 'Numer seryjny jest za długi (max 191 znaków).',
        ];
    }
}
