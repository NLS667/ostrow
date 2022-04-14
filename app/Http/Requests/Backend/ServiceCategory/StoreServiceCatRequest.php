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
            'description.required' => 'Opis jest za długi (max 255 znaków).',
        ];
    }
}
