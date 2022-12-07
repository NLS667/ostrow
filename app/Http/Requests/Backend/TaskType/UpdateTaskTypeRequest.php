<?php

namespace App\Http\Requests\Backend\TaskType;

use App\Http\Requests\Request;

/**
 * Class UpdateTaskTypeRequest.
 */
class UpdateTaskTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-tasktype');
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
            'description'   => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa Usługi nie może być pusta.',
            'name.max' => 'Nazwa jest za długa (max 255 znaków).',
            'description.max' => 'Opis jest za długi (max 255 znaków).',
        ];
    }
}
