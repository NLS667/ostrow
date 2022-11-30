<?php

namespace App\Http\Requests\Backend\Note;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreNoteRequest.
 */
class StoreNoteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-note');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content'              => 'required',
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
            'content.required' => 'Musisz wprowadzić jakiś tekst.',
        ];
    }
}
