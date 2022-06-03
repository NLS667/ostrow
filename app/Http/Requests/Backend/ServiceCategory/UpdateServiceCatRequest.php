<?php

namespace App\Http\Requests\Backend\ServiceCategory;

use App\Http\Requests\Request;

/**
 * Class UpdateServiceCatRequest.
 */
class UpdateServiceCatRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-servicecat');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'name'          => 'required|max:255',
            'short_name'        => 'required|max:5',
            'description'   => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa Usługi nie może być pusta.',
            'name.max' => 'Nazwa jest za długa (max 255 znaków).',
            'short_name.required' => 'Musisz podać nazwę skrótową.',
            'short_name.max' => 'Skrót jest za długi (max 5 znaków).',
            'description.required' => 'Opis jest za długi (max 255 znaków).',
        ];
    }
}
