<?php

namespace App\Http\Requests\Backend\Note;

use App\Http\Requests\Request;

/**
 * Class UpdateNoteRequest.
 */
class UpdateNoteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-note');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'content'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Notatka musi zawierać jakąś treść.',
        ];
    }
}
