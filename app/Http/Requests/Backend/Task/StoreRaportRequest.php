<?php

namespace App\Http\Requests\Backend\Task;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreRaportRequest.
 */
class StoreRaportRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-task-raport');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
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
            
        ];
    }
}
