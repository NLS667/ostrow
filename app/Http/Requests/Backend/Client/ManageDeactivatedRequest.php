<?php

namespace App\Http\Requests\Backend\Client;

use App\Http\Requests\Request;

/**
 * Class ManageDeactivatedRequest.
 */
class ManageDeactivatedRequest extends Request
{
    /**
     * Determine if the client is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-deactive-client');
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
