<?php

namespace App\Http\Requests\Backend\Task;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateTaskRequest.
 */
class UpdateTaskRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-task');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_id'         => 'required',
            'start'              => 'required',
            'end'                => 'nullable'
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
            'service_id.required'        => 'Musisz wybrać uslugę.',
            'start.required '            => 'Musisz podać datę rozpoczęcia zadania.'
        ];
    }
}
