<?php

namespace App\Http\Requests\Backend\ServiceCategory;

use App\Http\Requests\Request;

/**
 * Class DeleteServiceCatRequest.
 */
class DeleteServiceCatRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-servicecat');
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
