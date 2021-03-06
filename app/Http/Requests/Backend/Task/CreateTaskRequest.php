<?php

namespace App\Http\Requests\Backend\Task;

use App\Http\Requests\Request;

/**
 * Class CreateTaskRequest.
 */
class CreateTaskRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-task');
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
