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
            'name'              => 'required|max:255',
            'description'       => 'max:255',
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
            'name.required' => 'Musisz podać nazwę Modelu.',
            'name.max' => 'Nazwa jest za długa (max 255 znaków).',
            'description.required' => 'Opis jest za długi (max 255 znaków).',
            'producer.required' => 'Musisz wybrać Producenta Modelu.',
        ];
    }
}
