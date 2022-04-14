<?php

namespace App\Http\Requests\Backend\Model;

use App\Http\Requests\Request;

/**
 * Class UpdateModelRequest.
 */
class UpdateModelRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-model');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'producer'      => 'required',
            'name'          => 'required|max:255',
            'description'   => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'producer.required' = 'Musisz wybrać Producenta.',
            'name.required' => 'Nazwa Modelu nie może być pusta.',
            'name.max' => 'Nazwa jest za długa (max 255 znaków).',
            'description.required' => 'Opis jest za długi (max 255 znaków).',
        ];
    }
}
