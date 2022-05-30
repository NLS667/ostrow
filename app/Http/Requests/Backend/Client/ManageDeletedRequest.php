<?php

namespace App\Http\Requests\Backend\Client;

use App\Http\Requests\Request;

/**
 * Class ManageDeletedRequest.
 */
class ManageDeletedRequest extends Request
{
    /**
     * Determine if the client is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-deleted-client');
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
