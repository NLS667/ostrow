<?php

namespace App\Http\Requests\Backend\TaskType;

use App\Http\Requests\Request;

/**
 * Class ManageTaskTypeRequest.
 */
class ManageTaskTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-tasktype-management');
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
