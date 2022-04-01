<?php

namespace App\Http\Requests\Backend\Producer;

use App\Http\Requests\Request;

/**
 * Class EditProducerRequest.
 */
class EditProducerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-producer');
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
