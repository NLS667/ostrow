<?php

namespace App\Http\Requests\Backend\Task;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreTaskRequest.
 */
class StoreTaskRequest extends Request
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
            'service_id'         => 'required',
            'assignee_id'        => 'required',
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
            'assignee_id.required'       => 'Musisz wybrać pracownika.',
            'start.required '            => 'Musisz podać datę rozpoczęcia zadania.'
        ];
    }
}
