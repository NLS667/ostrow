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
            'title'              => 'required|max:191',
            'description'        => 'nullable|max:191',
            'start'              => 'required'
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
            'title.required'        => 'To pole jest wymagane.',
            'title.max'             => 'Długość max. 191 znaków.',
            'description.max'       => 'Długość max. 191 znaków.',
            'start.required'        => 'Musisz podać datę rozpoczęcia zadania.',
        ];
    }
}
