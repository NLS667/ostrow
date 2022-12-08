<?php

namespace App\Http\Requests\Backend\ServiceCategory;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreServiceCatRequest.
 */
class StoreServiceCatRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-servicecat');
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
            'short_name'        => 'required|max:5',
            'type'              => 'required',
            'description'       => 'max:255',
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
            'name.required' => 'Musisz podać nazwę Usługi.',
            'name.max' => 'Nazwa jest za długa (max 255 znaków).',
            'short_name.required' => 'Musisz podać nazwę skrótową.',
            'short_name.max' => 'Skrót jest za długi (max 5 znaków).',
            'type.required' => 'Musisz wybrać typ Usługi.',
            'description.max' => 'Opis jest za długi (max 255 znaków).',
        ];
    }
}
