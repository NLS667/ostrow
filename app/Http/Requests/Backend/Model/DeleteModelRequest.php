<?php

namespace App\Http\Requests\Backend\Model;

use App\Http\Requests\Request;

/**
 * Class DeleteModelRequest.
 */
class DeleteModelRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-model');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
