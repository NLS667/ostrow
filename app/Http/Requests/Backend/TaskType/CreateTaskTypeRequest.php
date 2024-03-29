<?php

namespace App\Http\Requests\Backend\TaskType;

use App\Http\Requests\Request;

/**
 * Class CreateTaskTypeRequest.
 */
class CreateTaskTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-tasktype');
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
